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
        $pass = $this->auth->check()?true: false;

        $currentRoute = \Route::getCurrentRoute()->getPath();
        if(strpos($currentRoute,'[')){
          $currentRoute = preg_split('/[[]/',$currentRoute)[0];
        }
        if(strpos($currentRoute,':')){
          $currentRoute = preg_split('/[:]/',$currentRoute)[0];
        }
        if(substr($currentRoute,-1)=='s'){
          $currentRoute = substr($currentRoute,0,-1);
        }
        $currentRoute = \Route::getCurrentRoute()->getPath()=="admin/users[edit:show]"?"admin/users[edit:show]":$currentRoute;

        //echo $currentRoute;
        if($pass){
          $pass = false;
          $role = DB::table('roles')->get();
          foreach($role as $rolerS){
            if(User::find($this->auth->user()->id)->hasRole($rolerS->name)==1){
              $userRole = $rolerS->name;
              $role_id = $rolerS->id;
            }
          }

          $resultPermission = DB::table('permissions')
                  ->join('permission_role', 'permission_role.permission_id' , '=' , 'permissions.id')
                  ->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
                  ->join('modules', 'modules.id', '=', 'permissions.action')
                  ->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
                           'roles.display_name as role_dn', 'permissions.name as per_name',
                           'permissions.display_name as per_dn', 'permissions.action as action',
                           'permissions.access as access', "modules.route as module_name",
                           'modules.id as mID')
                  ->where('permissions.type', 'module')
                  ->where('roles.id', $role_id) //Permission Dapat Melihat
                  ->get(); //->toSql();;

                  foreach($resultPermission as $rsP){
                      //echo $currentRoute . " = " . $rsP->module_name . " is " . ($currentRoute==$rsP->module_name) ."||";
                      if($currentRoute==$rsP->module_name){
                        $pass = true;
                      }

                      if(preg_match("/\bnews/i", $currentRoute)){
                        $pass=true;
                      }

                      if($currentRoute=="admin/form" || $currentRoute=="admin/filesList/{id}" || $currentRoute=="admin/setGrid" ||
                        $currentRoute=="admin/users[edit:show]" || $currentRoute=="admin/users[edit:save]" || $currentRoute=="news"
                        || $currentRoute=="news/{id}" ){
                        $pass=true;
                      }
                  }
        }


                if(!$pass){
                  echo $currentRoute;
                  //return redirect('unauthorized')->with('errors', 'Maaf anda harus login terlebih dahulu');
                }


        return $next($request);
    }

}
