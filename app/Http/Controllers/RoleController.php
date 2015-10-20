<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Role;

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
        return view('_layout.form-role-backend', compact('rS', 'as', 'rS2'));
    }

    public function save(Request $request){
        $as = $request->input('as');
        $role = new Role;
        $validator = \Validator::make($request->all(), $role->getRules());
        $results = new \StdClass;

        if($validator->passes()){
            if($request->has('id')){
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
        return view('_layout.tabel-roles', compact('result'));
    }

    public function del(Request $request){
        $result= DB::table('roles')
                    ->where('id', $request->input('id'))
                    ->delete();
        return $result==true?"succes del":"fail del";
    }

    public function showPermission(Request $request){
        $result = DB::table('permission_role')
                  ->join('permissions', 'permissions.id' , '=' , 'permission_role.permission_id')
                  ->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
                  ->join('parent_frontpage', 'parent_frontpage.id', '=', 'permission_role.action')
                  ->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
                           'roles.display_name as role_dn', 'permissions.name as per_name',
                           'permissions.display_name as per_dn', 'permission_role.action as action',
                           'permission_role.access as access', "parent_frontpage.nama as menu_nama")
                  ->where('permission_role.role_id', $request->input('id'))
                  ->get();
        echo print_r($result);
        return view('_layout.tabel.roles-permission', compact('result'));
    }
}
