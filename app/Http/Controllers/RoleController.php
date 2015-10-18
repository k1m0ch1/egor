<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $dataSave = Array('name'=>$request->input('name'),
                           'display_name'=>$request->input('displayname'),
                           'description'=>$request->input('description'));
        if($as=="edit"){
            $hasil = DB::table('roles')->where('id', $request->input('id'))->update($dataSave);
        }else{
            $hasil = DB::table('roles')->insert($dataSave);
        }

        return $hasil==true?"success save":"fail save";
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
