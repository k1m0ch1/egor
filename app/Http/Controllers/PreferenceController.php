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
        $value = $request->input('value');
        //$value = preg_replace('/\s+/','',$request->input('value'));
        $value = ltrim($request->input('value'));

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

        $results = new \StdClass;
        $results->info = $name.' preference save';
        $results->status = 1;
        $results->message = ucwords($name).' has been successfuly updated';
        $results->result = $result;

        return response()->json($results);
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
    	$name = $request->input('name');
        $value = $request->input('value');

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

        $results = new \StdClass;
        $results->info = 'title preference save';
        $results->status = 1;
        $results->message = 'Title has been successfuly updated';
        $results->result = $result;

        return response()->json($results);
    }
}
