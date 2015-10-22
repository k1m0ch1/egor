<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use DB;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // if ($this->auth->guest()) {
        //     if ($request->ajax()) {
        //         return response('Unauthorized.', 401);
        //     } else {
        //         return redirect()->guest('index');
        //     }
        // }

        //$this->auth->user()->name;

        // $role = DB::table('roles')->get();
        // foreach($role as $rolerS){
        //   if(User::find($this->auth->user()->id)->hasRole($rolerS->name)==1){
        //     $userRole = $rolerS->name;
        //     $role_id = $rolerS->id;
        //   }
        // }
        if($this->auth->user()->name=="guest"){
          if ($request->ajax()) {
                  return response('Unauthorized.', 401);
          } else {
                  return response('Unauthorized.', 401);
          }
        }

        return $next($request);
    }
}
