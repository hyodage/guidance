<?php
namespace app\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * 前台验证中间件
 */
class AuthMember{
    public function handle($request,Closure $next,$guard=null){
        if(Auth::guard('member')->guest()){
            if($request->ajax()){
                return response(json_encode(['code'=>401,'msg'=>'未登录']),200);
            }
            return redirect()->guest('/');
        }
        return $next($request);
    }
}
