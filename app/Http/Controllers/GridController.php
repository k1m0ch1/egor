<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\ParentFrontpage;

class GridController extends Controller
{
// <<<<<<< HEAD
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function savePosition(Request $request){
//         $datanya = json_decode($request->input('dataWaw'));
//     	$jumlahData = $request->input('size');
//         $debug = Array();

//         DB::listen(
//                     function ($sql) {
//                         echo $sql . "<br/>";
//                     }
//                 );  

//     	for($a=0;$a<$jumlahData;$a++){
//     		DB::table('parent_frontpage')->where('id', $datanya[$a][1])->update(['position' => $datanya[$a][0]]);
//     		//$fucka .= '' . $datanya[$a][1] . '' .$datanya[$a][0] . '<br/>';
//         }

//         //$debug = "" . print_r(json_decode($datanya));

//     	return "damn";
//     }
// =======
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function savePosition(Request $request){
		$data = $request->input('dataWaw');

		$jumlahData = $request->input('size');
		$results = array();

		foreach($data as $d){
			$result = ParentFrontpage::find($d[0]);
			if(is_null($result)){
				dd($d[0]);
			}
			$result->position = $d[1];
			$result->save();
			array_push($results, $result);
		}

		return response()->json($results);
	}

	public function getGridSize(){
		 // Atur Grid Menu
		$h = Setting::where('name', 'grid_height')->get();
		if(count($h)>0){
			$h = $h->first()->value;
			
		}else{
			$h = 3;
		}

		$w = Setting::where('name', 'grid_width')->get();
		if(count($w)>0){
		   $w =$w->first()->value;
			
		}else{
		   $w = 3;
		}

		$result = new \StdClass;
		$result->h = $h;
		$result->w = $w;

		return response()->json($result);
	}
}
