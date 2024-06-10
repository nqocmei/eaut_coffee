<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\Admin\AdminInterface;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    private $AdminRepository;

    public function __construct(AdminInterface $AdminRepository)
    {
        $this->AdminRepository = $AdminRepository;
    }

    public function index()
    {
        if (@Auth::user()->id_role == 1) {
            return view('admin_login');
        } else {
            return redirect('/404');
        }
    }

    public function dashboard()
    {
        $totalsCustomer = $this->AdminRepository->totalsCustomer();
        $totalsOrders = $this->AdminRepository->totalsOrders();
        $totalsMoney = $this->AdminRepository->totalsMoney();
        $totalsSaleProducts = $this->AdminRepository->totalsSaleProducts();
        return view('admin.dashboard', compact('totalsCustomer', 'totalsOrders', 'totalsMoney', 'totalsSaleProducts'));

    }

    public function search(Request $request)
    {
        $searchs = $this->AdminRepository->searchProduct($request);
        return view('admin.products.search')->with('searchs', $searchs)->with('keyword', $request->input('keyword'));
    }

    public function signin_dashboard(Request $request)
    {
        return $this->AdminRepository->signIn($request);
    }

    public function admin_logout()
    {
        return $this->AdminRepository->logOut();
    }
}
