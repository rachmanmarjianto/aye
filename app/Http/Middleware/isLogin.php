<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!session()->has('userdata')) {
            Session::flush();
            return redirect('/login')->with([
                'status' => 'danger',
                'message' => 'Silahkan login terlebih dahulu.'
            ]);
        }

        if(in_array(session('userdata')['idrole'], $roles) || in_array('all', $roles)) {
            
            return $next($request);
        }
        else if(in_array('admin', $roles) && session('userdata')['admin'] == 1){
            return $next($request);
        }
        else{
            Session::flush();
            return redirect('/login')->with([
                'status' => 'danger',
                'message' => 'Anda tidak memiliki akses ke halaman tersebut.'
            ]);
        }
    }
}
