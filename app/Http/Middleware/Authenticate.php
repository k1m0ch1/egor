<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use DB;
use App\Models\User;

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
        }else{
          if($this->auth->user()->name=="admin"||$this->auth->user()->name=="tech"){
            $pass = true;
          }
        }

        return $next($request);
    }

}

//trash just to make sure it won't gone
// $currentRoute = \Route::getCurrentRoute()->getPath();
// if(strpos($currentRoute,'[')){
//   $currentRoute = preg_split('/[[]/',$currentRoute)[0];
// }
//
// $pass = false;
//
// $role = DB::table('roles')->get();
// foreach($role as $rolerS){
//   if(User::find($this->auth->user()->id)->hasRole($rolerS->name)==1){
//     $userRole = $rolerS->name;
//     $role_id = $rolerS->id;
//   }
// }
//
// $resultPermission = DB::table('permission_role')
//         ->join('permissions', 'permissions.id' , '=' , 'permission_role.permission_id')
//         ->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
//         ->join('modules', 'modules.id', '=', 'permission_role.action')
//         ->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
//                  'roles.display_name as role_dn', 'permissions.name as per_name',
//                  'permissions.display_name as per_dn', 'permission_role.action as action',
//                  'permission_role.access as access', "modules.route as module_name",
//                  'modules.id as mID')
//         ->where('permission_role.role_id', $role_id)
//         ->where('permission_role.permission_id', '1') //Permission Dapat Melihat
//         ->get(); //->toSql();;
//
// foreach($resultPermission as $rsP){
//     if($currentRoute==$rsP->module_name){
//       $pass = true;
//     }else if($rsP->module_name=="all module"){
//       $pass = true;
//     }
// }
//
//
// if($this->auth->user()->name=="admin"||$this->auth->user()->name=="tech"){
//   $pass = true;
// }
//
// if(!$pass){
//   return response('Unauthorized.', 401);
// }
