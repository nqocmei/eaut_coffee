<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Repositories\Cart\CartInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\OrderDetail;

class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function cart()
    {
        if (Auth::check()) {
            $carts = $this->cartRepository->getCartByUser(Auth::id());
            return view('pages.cart', compact('carts'));
        } else {
            return view('pages.cart');
        }
    }

    public function addProductToCart(Request $request, $id)
    {
        if (Auth::check()) {
            $cart = Cart::where('id_product', $id)->first();

            if (!$cart) {
                $product = Product::findOrFail($id);
                $userId = Auth::id();
                $cartData = [
                    'id_product' => $product->id,
                    'id_user' => $userId,
                    'quantity' => $request->query('quantity', 1),
                ];

                $this->cartRepository->store($cartData);

                return redirect()->back()->with('message', ['content' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'type' => 'success']);
            } else {

                $cart->quantity += $request->query('quantity', 1);
                $cart->save();

                return redirect()->back()->with('message', ['content' => 'Sản phẩm đã được thêm vào giỏ hàng!', 'type' => 'success']);
            }
        } else {
            return redirect()->back()->with('message', ['content' => 'Bạn phải đăng nhập để thêm sản phẩm vào giỏ hàng!', 'type' => 'error']);
        }
    }
    
    public function updateQuantityCart(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::findOrFail($request->id);
            if (!$cart) {
                return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại!'], 404);
            }
            $cart->quantity = $request->quantity;
            $cart->save();

            $totalPrice = $cart->product->promotional_price * $cart->quantity;
            $totalCart = $this->cartRepository->totalCartByUser(Auth::id());
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật giỏ hàng thành công!',
                'quantity' => $cart->quantity,
                'totalPrice' => number_format($totalPrice, 0, ',', '.') . 'đ',
                'totalCart' => number_format($totalCart, 0, ',', '.') . 'đ',
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Bạn phải đăng nhập để sử dụng chức năng này!'], 401);
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            if (Auth::user()) {
                $showusers = DB::table('user')
                    ->join('order', 'user.id', '=', 'order.id_user')
                    ->select('user.*')
                    ->where('user.id', Auth::id())
                    ->get();
                $carts = $this->cartRepository->getCartByUser(Auth::id());

                return view('pages.checkout', ['showusers' => $showusers, 'carts' => $carts]);
            }
        }
        return redirect('/login');
    }

    public function buyNow (Request $request, $id) {
        $this->addProductToCart($request, $id);
        return $this->checkout();
     }

    public function order(Request $request)
    {
        $validatedDataOrder = $request->validate([
            'recipient' => 'required',
            'total_funds' => 'required',
            'delivery_address' => 'required',
            'pickup_phone' => 'required',
        ]);

        $validatedDataOrder['recipient'] = $request->recipient;
        $validatedDataOrder['order_date'] = Carbon::now();
        $validatedDataOrder['delivery_date'] = null;
        $validatedDataOrder['total_funds'] = $request->total_funds;
        $validatedDataOrder['payment_methods'] = $request->redirect;
        $validatedDataOrder['delivery_address'] = $request->delivery_address;
        $validatedDataOrder['pickup_phone'] = $request->pickup_phone;
        // 0 - pedding, 1 - waiting, 2 - delivering, 3 - success
        $validatedDataOrder['status'] = 0;
        $validatedDataOrder['id_user'] = Auth::id();

        $newOrder = Order::create($validatedDataOrder);

        $validatedDataOrderDetail = $request->validate([
            'products' => 'required|array',
            'products.*.id_product' => 'required|integer',
            'products.*.quantity' => 'required|integer',
        ]);

        foreach ($validatedDataOrderDetail['products'] as $product) {
            OrderDetail::create([
                'id_order' => $newOrder->id,
                'id_product' => $product['id_product'],
                'quantity' => $product['quantity'],
                'id_user' => Auth::id(),
            ]);
        }

        $carts = $this->cartRepository->getCartByUser(Auth::id());

        foreach ($carts as $cart) {
            $cart->delete();
        }

        return view('pages.orderSuccess');
    }

    public function orderSuccess(Request $request)
    {
        if ($request->has('vnp_ResponseCode') && $request->has('vnp_TransactionNo')) {
            $responseCode = $request->input('vnp_ResponseCode');

            if ($responseCode == '00') {
                $requestData = $request->session()->get('vnp_RequestData');
                $fakeRequest = Request::create('', 'GET', $requestData);
                $this->order($fakeRequest);
                $request->session()->forget('vnp_RequestData');
                return view('pages.orderSuccess');
            } else {
                return redirect('/cart')->with('message', ['content' => 'Có lỗi xảy ra khi thanh toán!', 'type' => 'error']);
            }
        } else {
            return redirect('/cart')->with('message', ['content' => 'Có lỗi xảy ra khi thanh toán!', 'type' => 'error']);
        }

    }

    public function vnpay(Request $request)
    {
        $request->session()->put('vnp_RequestData', $request->all());

        $vnp_TmnCode = env('VNP_TMNCODE');
        $vnp_HashSecret = env('VNP_HASH_SECRET');

        $vnp_Url = env('VNP_URL');
        $vnp_Returnurl = env('APP_URL') . "/order-success";
        $vnp_TxnRef = date("YmdHis");
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_funds * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";

        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        // dd($vnp_Url);

        return redirect($vnp_Url);
    }
}
