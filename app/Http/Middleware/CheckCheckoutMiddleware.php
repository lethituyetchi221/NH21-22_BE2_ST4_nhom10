<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cart;



class CheckCheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $content = Cart::content();
        if (count($content) != 0) {
            return $next($request);
        }else{
            return redirect()->back()->with('Error','Giỏ hàng trống');
        }
    }
}
