<?php

namespace App\Http\Controllers;

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

    public function titleSave(Request $request){
    	DB::table('preference')->where('id', '1')->update(['title' => $request->input('judul')]);

    	return 'success';
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