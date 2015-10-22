<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Module;

class ModuleController extends Controller
{
    public function form(Request $request){
        $as = $request->input('as');

        $rS[0] = new \StdClass();
        $rS[0]->id = "xxx";
        $rS[0]->name = "";
        $rS[0]->route = "";
        $rS[0]->description = "";

        if($as!="add"){
            $rS = DB::table('modules')->where('id', $request->input('id'))->get();
        }
        return view('_layout.form.module-backend', compact('rS', 'as'));
    }

    public function save(Request $request){
        $as = $request->input('as');
        $module = new Module;
        $validator = \Validator::make($request->all(), $module->getRules());
        $results = new \StdClass;

        if($validator->passes()){
            if($request->input('id')!="xxx"){
                $module = Module::find($request->input('id'));
                $module->name = $request->input('name');
                $module->route = $request->input('route');
                $module->description = $request->input('description');
                $module->save();
                $results->info = 'module create';
            }else{
                $module = new Module;
                $module->name = $request->input('name');
                $module->route = $request->input('route');
                $module->description = $request->input('description');
                $module->save();
                $results->info = 'module edit';
            }
            $results->status = 1;
            $results->result = $module;
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
        $result = DB::table('modules')->get();
        return view('_layout.tabel.module', compact('result'));
    }

    public function del(Request $request){
        $result= DB::table('modules')
                    ->where('id', $request->input('id'))
                    ->delete();
        return $result==true?"succes del":"fail del";
    }
}
