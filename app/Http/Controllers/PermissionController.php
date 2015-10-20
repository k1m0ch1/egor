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
            $rS = DB::table('permissions')->where('id', $request->input('id'))->get();
        }
        return view('_layout.form-permission-backend', compact('rS', 'as'));
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
                $permission->display_name = $request->input('displayname');
                $permission->description = $request->input('description');
                $permission->access = $request->input('access');
                $permission->action = $request->input('action');
                $permission->save();
                $results->info = 'permission create';
            }else{
                $permission = new Permission;
                $permission->name = $request->input('name');
                $permission->display_name = $request->input('displayname');
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
        return view('_layout.tabel-permission', compact('result'));
    }

    public function del(Request $request){
        $result= DB::table('permissions')
                    ->where('id', $request->input('id'))
                    ->delete();
        return $result==true?"succes del":"fail del";
    }
}
