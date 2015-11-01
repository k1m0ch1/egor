<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function form(Request $request){
        $as = $request->input('as');

        $rS[0] = new \StdClass();
        $rS[0]->id = "xxx";
        $rS[0]->name = "";
        $rS[0]->display_name = "";
        $rS[0]->description = "";
        $rS[0]->access = "";
        $rS[0]->action = "";

        if($as!="add"){
            $rS = Permission::find($request->input('id'))->get();
        }
        return view('_layout.form.form-permission-backend', compact('rS', 'as'));
    }

    public function save(Request $request){
        $as = $request->input('as');
        $permission = new Permission;
        $validator = \Validator::make($request->all(), $permission->getRules());
        $results = new \StdClass;

        if($validator->passes()){
            if($request->input('id')!="xxx"){
                $permission = Permission::find($request->input('id'));
                $permission->name = $request->input('name');
                $permission->display_name = $request->input('accessaction');
                $permission->description = $request->input('description');
                $permission->access = $request->input('access');
                $permission->action = $request->input('action');
                $permission->save();
                $results->info = 'permission create';
            }else{
                $permission = new Permission;
                $permission->name = $request->input('name');
                $permission->display_name = $request->input('accessaction');
                $permission->description = $request->input('description');
                $permission->access = $request->input('access');
                $permission->action = $request->input('action');
                $permission->save();
                $results->info = 'permission edit';
            }
            $results->status = 1;
            $results->result = $permission;
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
        $result = DB::table('permissions')->get();
        return view('_layout.tabel.tabel-permission', compact('result'));
    }
    public function showPermission(Request $request){

      $result = DB::table('permissions')
                    ->select('permissions.id as id', 'modules.name as name')
                    ->join('modules', 'permissions.action', '=', 'modules.id')
                    ->where('permissions.type','module')
                    ->get();

      $rSapps = DB::table('permissions')
                  ->select('permissions.id as id', 'parent_frontpage.nama as nama')
                  ->join('parent_frontpage', 'permissions.action', '=', 'parent_frontpage.id')
                  ->where('permissions.type','app')
                  ->get();

        // $result = DB::table('modules')->get();
        // $rSapps = DB::table('parent_frontpage')->get();
        $role_id = $request->input('role_id');
        return view('_layout.form.role-set-permission', compact('result','rSapps' ,'role_id','modChecked','appChecked'));
    }

    public function modChecked(Request $request){
      $modChecked = DB::table('permission_role')
                    ->select('permissions.id')
                    ->join('permissions','permissions.id','=','permission_role.permission_id')
                    ->join('roles','permission_role.role_id','=','roles.id')
                    ->where('roles.id',$request->input('role_id'))
                    ->where('permissions.type','module')
                    ->get();

      return json_encode($modChecked);
    }

    public function appChecked(Request $request){
      $appChecked = DB::table('permission_role')
                    ->select('permissions.id')
                    ->join('permissions','permissions.id','=','permission_role.permission_id')
                    ->join('roles','permission_role.role_id','=','roles.id')
                    ->where('roles.id',$request->input('role_id'))
                    ->where('permissions.type','app')
                    ->get();

      return json_encode($appChecked);
    }

    public function del(Request $request){
        $result= DB::table('permissions')
                    ->where('id', $request->input('id'))
                    ->delete();
        return $result==true?"succes del":"fail del";
    }

    public function view($id){
        $result = Permission::find($id);

        return response()->json($result);
    }
}
