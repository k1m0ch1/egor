<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$results = new \StdClass;
		$results->info = "menu index";
		$results->status = "success";
		$results->messages = "This is list of menu available";
		$results->result = array();

		return response()->json($results);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function editSave(Request $request){
		return (DB::table('parent_menu')->where('id', $request->input('id'))
                        ->update(
                        ['name' => $request->input('name'),
                         'redirect' => $request->input('redirect')]))==true?"success":"fail";;

	}

	public function select2(Request $request){
		$hasil = DB::table('parent_menu')->where('id', $request->input('id'))->get();
		return json_encode($hasil);
	}

	public function addSave(Request $request){
		$hasil = DB::table('parent_menu')->insert(['name'=> $request->input('name'),
			'redirect'=> $request->input('redirect')]);
		return $hasil==true?"success":"fail";
	}

	public function selectWhere(Request $request){
		$hasil = DB::table('parent_menu')->where('name', $request->input('name'))
				->where('redirect', $request->input('redirect'))
				->get();
		return json_encode($hasil);
	}

	public function getChild(Request $request){
		$hasil = DB::table('child_menu')->where('parent_id', $request->input('id'))->get();
		$parent_id = $request->input('id');
		return view('_layout.dialog-child-menu-backend', compact('hasil', 'parent_id'));
	}

	public function newChild(Request $request){
		$parent_id = $request->input('id');
		return view('_layout.form-new-input-menu-backend', compact('parent_id'));
	}

	public function delChild(Request $request){
		$parent_id = $request->input('parent_id');
		$child_id = $request->input('id');
		$hasil = DB::table('child_menu')->where('parent_id', $parent_id)
					->where('id', $child_id)->delete();
		return $hasil==true?"success delChild":"fail delChild";
	}

	public function delParent(Request $request){
		$parent_id = $request->input('parent_id');
		$child_id = $request->input('id');
		$hasil = DB::table('child_menu')->where('parent_id', $parent_id)
					->where('id', $child_id)->delete();
		return $hasil==true?"success delChild":"fail delChild";
	}

	public function editChild(Request $request){
		$parent_id = $request->input('parent_id');
		$id = $request->input('id');
		$hasil = DB::table('child_menu')->where('parent_id', $parent_id)
					->where('id', $id)->get();
		foreach($hasil as $rS){
			$name = $rS->name;
 			$redirect = $rS->redirect;
		}
		return view('_layout.form-input-menu-backend', compact('parent_id', 'id','name','redirect'));
	}

	public function editChildSave(Request $request){
		return (DB::table('child_menu')->where('id', $request->input('id'))
						->where('parent_id', $request->input('parent_id'))
						->update(
                        ['name' => $request->input('name'),
                         'redirect' => $request->input('redirect')]))==true?
						"success editChildSave":"fail editChildSave";

	}

	public function saveNewChild(Request $request){
		$id = $request->input('id');
		$parent_id = $request->input('parent_id');
		$hasil ='';
		if($id=='xxx'){
			$hasil = DB::table('child_menu')
					 ->insert([
					 		'parent_id' => $request->input('parent_id'),
					 		'name' => $request->input('name'),
					 		'redirect' => $request->input('redirect')
					 	]);
		}else{
			$hasil = DB::table('child_menu')
					 ->where('parent_id', $parent_id)
					 ->where('id', $id)
					 ->update([
					 		'name' => $request->input('name'),
					 		'redirect' => $request->input('redirect')
					 	]);
		}
		
		return $hasil==true?"success saveNewChild":"fail saveNewChild";
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
