<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function form(Request $request){
        $as = $request->input('as');

        $rS[0] = new \StdClass();
        $rS[0]->id = "xxx";
        $rS[0]->name = "";
        $rS[0]->display_name = "";
        $rS[0]->description = "";
        $rS2 = DB::table('permissions')->get();

        if($as!="add"){
            $rS = DB::table('roles')->where('id', $request->input('id'))->get();
        }
        return view('_layout.form.form-role-backend', compact('rS', 'as', 'rS2'));
    }

    public function save(Request $request){
        $as = $request->input('as');
        $role = new Role;
        $validator = \Validator::make($request->all(), $role->getRules());
        $results = new \StdClass;

        if($validator->passes()){
            if($request->input('id')!='xxx'){
                $role = Role::find($request->input('id'));
                $role->name = $request->input('name');
                $role->display_name = $request->input('displayname');
                $role->description = $request->input('description');
                $role->save();
                $results->info = 'role create';
            }else{
                $role = new Role;
                $role->name = $request->input('name');
                $role->display_name = $request->input('displayname');
                $role->description = $request->input('description');
                $role->save();
                $results->info = 'role edit';
            }
            $results->status = 1;
            $results->result = $role;
        }else{
            $results->status = 0;
            $result = array();
            foreach ($validator->errors() as $key => $err) {
                array_push($result, $err);
            }
            $results->result = $result;
        }

        return response()->json($results);
    }

    public function show(){
        $result = DB::table('roles')->get();
        return view('_layout.tabel.tabel-roles', compact('result'));
    }

    public function del(Request $request){
        $result= DB::table('roles')
                    ->where('id', $request->input('id'))
                    ->delete();
        return $result==true?"succes del":"fail del";
    }

    public function showPermission(Request $request){

        // Deprecated Function, just to make it comment first.. in case I need it
        // $result = DB::table('permission_role')
        //           ->join('permissions', 'permissions.id' , '=' , 'permission_role.permission_id')
        //           ->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
        //           ->join('parent_frontpage', 'parent_frontpage.id', '=', 'permission_role.action')
        //           ->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
        //                    'roles.display_name as role_dn', 'permissions.name as per_name',
        //                    'permissions.display_name as per_dn', 'permission_role.action as action',
        //                    'permission_role.access as access', "parent_frontpage.nama as menu_nama")
        //           ->where('permission_role.role_id', $request->input('id'))
        //           ->get();
        //
        // $resultPermission = DB::table('permission_role')
        //           ->join('permissions', 'permissions.id' , '=' , 'permission_role.permission_id')
        //           ->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
        //           ->join('modules', 'modules.id', '=', 'permission_role.action')
        //           ->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
        //                    'roles.display_name as role_dn', 'permissions.name as per_name',
        //                    'permissions.display_name as per_dn', 'permission_role.action as action',
        //                    'permission_role.access as access', "modules.name as module_name",
        //                    'modules.id as mID')
        //           ->where('permission_role.role_id', $request->input('id'))
        //           ->get();

        $result = DB::table('permissions')
                  ->select('permissions.name as pName', 'permissions.display_name as dn',
                           'roles.name as r_names', 'roles.id as rID',
                           'permissions.id as pID', 'permissions.action as action')
                  ->join('permission_role','permissions.id', '=', 'permission_role.permission_id')
                  ->join('roles', 'permission_role.role_id', '=', 'roles.id')
                  ->where('roles.id', $request->input('id'))
                  ->where('permissions.type', "module")
                  ->get();

        $resultPermission = DB::table('permissions')
                  ->select('permissions.name as pName', 'permissions.display_name as dn',
                           'roles.name as r_names', 'roles.id as rID',
                           'permissions.id as pID', 'permissions.action as action')
                  ->join('permission_role','permissions.id', '=', 'permission_role.permission_id')
                  ->join('roles', 'permission_role.role_id', '=', 'roles.id')
                  ->where('roles.id', $request->input('id'))
                  ->where('permissions.type', "app")
                  ->get();


        $role_id = $request->input('id');
        return view('_layout.tabel.roles-permission', compact('result','role_id','resultPermission'));
    }

    public function delSetPermission(Request $request){
      $result = DB::table('permission_role')
                ->where('permission_id', $request->input('pID'))
                ->where('role_id', $request->input('rID'))
                ->delete();
      return $result==true?"success delSetPermission":"fail delSetPermission";
    }

    public function setPermission(Request $request){
        $role_id = $request->input('role_id');

        $modPerm = json_decode($request->input('modPerm'),true);
        $appPerm = json_decode($request->input('appPerm'),true);

        $role = Role::find($request->input('role_id'));

        $permissionAll = DB::table('permissions')->select('id')->where('type', 'module')->get();

        $modChecked = DB::table('permission_role')->select('permission_role.permission_id as id')
                      ->join('permissions','permissions.id','=','permission_role.permission_id')
                      ->join('roles','permission_role.role_id','=','roles.id')
                      ->where('roles.id',$request->input('role_id'))
                      ->where('permissions.type','module')
                      ->get();

        $appPermissionAll = DB::table('permissions')->select('id')->where('type', 'app')->get();

        $appChecked = DB::table('permission_role')->select('permission_role.permission_id as id')
                    ->join('permissions','permissions.id','=','permission_role.permission_id')
                    ->join('roles','permission_role.role_id','=','roles.id')
                    ->where('roles.id',$request->input('role_id'))
                    ->where('permissions.type','app')
                    ->get();

        //module-save
        $a=0;
        $perm = Array();
        foreach($permissionAll as $pa){
          $perm[$a] = $pa->id;
          $a++;
        }

        for($a=0;$a<count($perm);$a++){
          if(!in_array($perm[$a], $modPerm)){
            DB::table('permission_role')
                      ->where('role_id', $request->input('role_id'))
                      ->where('permission_id', $perm[$a])
                      ->delete();
            //echo $perm[$a] . "DELETED||";
          }
        }

        $a=0;
        foreach($modChecked as $pa){
          $perm[$a] = $pa->id;
          $a++;
        }
        $b=0;
        for($a=0;$a<count($modPerm);$a++){
          if(!in_array($modPerm[$a], $perm)){
            $role->attachPermission($modPerm[$a]);
            //echo $modPerm[$a] . "ADDED||";
          }
        }

        //app-savve

        $a=0;
        $perm = Array();
        foreach($appPermissionAll as $pa){
          $perm[$a] = $pa->id;
          $a++;
        }

        for($a=0;$a<count($perm);$a++){
          if(!in_array($perm[$a], $appPerm)){
            DB::table('permission_role')
                      ->where('role_id', $request->input('role_id'))
                      ->where('permission_id', $perm[$a])
                      ->delete();
            //echo $perm[$a] . "DELETED||";
          }
        }

        $a=0;
        foreach($appChecked as $pa){
          $perm[$a] = $pa->id;
          $a++;
        }
        $b=0;
        for($a=0;$a<count($appPerm);$a++){
          if(!in_array($appPerm[$a], $perm)){
            $role->attachPermission($appPerm[$a]);
            // echo $modPerm[$a] . "ADDED||";
          }
        }



        return "success";
    }
}
