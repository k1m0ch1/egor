<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index(){

    }

    public function preferenceSave(Request $request){
        $name = $request->input('name');
        $value = str_replace(' ','',$request->input('value'));
        $result = Setting::where('name', $name)->get();
        $trigger = count($result)>0?true:false;
        if($trigger){
            $result = $result->first();
            $result->value = $value;
            $result->save();
        }else{
            $result = new Setting;
            $result->name = $name;
            $result->value = $value;
            $result->save();
        }
    }

    public function backgroundSave(Request $request){
    	DB::table('preference')->where('id', '1')->update(['background' => $request->input('namaFile')]);

    	return 'success';
    }
    public function logoSave(Request $request){
    	DB::table('preference')->where('id', '1')->update(['logo' => $request->input('namaFile')]);

    	return 'success';
    }

    public function title(){
    	$rS = DB::table('preference')->where('id', '1')->get();
    	return $rS->title;
    }
}