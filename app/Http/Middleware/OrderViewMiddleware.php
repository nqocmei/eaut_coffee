<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderViewMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->id){

            $order = Order::where('id_user', Auth::user()->id)->where('id', $request->route('id'))->first();
            if($order){
                return $next($request);
            }else{
                return redirect('/order');
            }
        }
        else {
            return redirect('/');
        }

    }
}
