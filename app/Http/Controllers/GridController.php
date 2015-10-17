<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function savePosition(Request $request){
        $datanya = json_decode($request->input('dataWaw'));
    	$jumlahData = $request->input('size');
        $debug = Array();

        DB::listen(
                    function ($sql) {
                        echo $sql . "<br/>";
                    }
                );  

    	for($a=0;$a<$jumlahData;$a++){
    		DB::table('parent_frontpage')->where('id', $datanya[$a][1])->update(['position' => $datanya[$a][0]]);
    		//$fucka .= '' . $datanya[$a][1] . '' .$datanya[$a][0] . '<br/>';
        }

        //$debug = "" . print_r(json_decode($datanya));

    	return "damn";
    }
}
