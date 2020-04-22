<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(Auth::user()->ruler >= 1){
                return $next($request);
            }else{
                return redirect()->route('admin.login')->with(['ctErrorrs' => 1,'ctMessage' => 'Bạn không có quyền truy cập trang này']);
            }
        }else{
            return redirect()->route('admin.login')->with(['ctErrorrs' => 1,'ctMessage' => 'Bạn không có quyền truy cập trang này']);
        }
    }
}
