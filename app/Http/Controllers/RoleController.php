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

        if($as!="add"){
            $rS = DB::table('roles')->where('id', $request->input('id'))->get();
        }
        return view('_layout.form-role-backend', compact('rS', 'as'));
    }

    public function save(Request $request){
        $as = $request->input('as');
        $role = new Role;
        $validator = \Validator::make($request->all(), $role->getRules());
        $results = new \StdClass;

        if($validator->passes){
            if($request->has('id')){
                $role = Role::find($id);
                $role->name = $request->name;
                $role->display_name = $request->display_name;
                $role->description = $request->description;
                $role->save();
                $results->info = 'role create';
            }else{
                $role = new Role;
                $role->name = $request->name;
                $role->display_name = $request->display_name;
                $role->description = $request->description;
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
}
