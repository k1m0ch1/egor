<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;

class UsersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	public function show(Request $request)
	{
		$hasil = '';
		$name = "";
		$email = "";
		$phone = "";
		$department = "";
		$idnyah = "xxx";
		$resultRole = Role::All();
		if($request->input('as')!="add"){
			$result1 = DB::table('users')->where('id', $request->input('id'))->get();
			foreach($result1 as $rS){
				$name = $rS->name;
				$email = $rS->email;
				$idnyah = $rS->id;
				$phone = $rS->phone;
				$department = $rS->department;
			}
		}
		return view('_layout.form-input-user-backend', compact('phone','department','name','email', 'idnyah','resultRole'));
	}

	public function showAll(){
		$result = User::All();
		return view('_layout.tabel-user', compact('result'));
	}

	public function delete(Request $request){
		$rS = User::find($request->input('id'))->delete();
		return "success";
	}

	public function save(Request $request){
		$allowed = array('png', 'jpg', 'gif');
		$hasil = false;
		$avatar = 'holder.js/180x180';
		$users = new User;
		$destination = User::UPLOAD_PATH;
		$validator = \Validator::make($request->all(), $users->getRules());
		$results = new \StdClass;
		$filename = '';
		if($request->has('id')){
			$user = User::find($request->input('id'));
			if($request->input('email') == $user->email){
				$valid = \Validator::make($request->all(), [
					'name' => 'required',
					'email' => 'required|email',
					'roles' => 'required'
				]);
			}else{
				$valid = \Validator::make($request->all(), [
					'name' => 'required',
					'email' => 'required|email|unique:users,email',
					'roles' => 'required'
				]);
			}

			if($valid->passes()){
				$results->info = 'users update';

				if($request->hasFile('avatar')){
					if($request->file('avatar')->isValid()){
						$filename = date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('avatar')->guessExtension();
						$img = \Image::make($request->file('avatar'))->fit(200, 200)->save($destination.$filename);
					}
				}

				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->phone = $request->input('phone');
				$user->department = $request->input('department');
				$user->avatar = $filename;
				$user->save();
				$rsRole = Role::find($request->input('roles'));
				$rsUser = User::find($user->id)->attachRole($rsRole);
				$results->status = 1;
			}else{
				$results->status = 0;
				$results->info = 'users management';
				$message = array();

				foreach($valid->errors()->all() as $m){
					array_push($message, $m);
				}
				$results->message = $message;
			}
		}else{
		   if($validator->passes()){
			$user = new User;
			$user->password = \Hash::make($request->input('password'));
			$results->info = 'users create';
			if($request->hasFile('avatar')){
				if($request->file('avatar')->isValid()){
					$filename = date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('avatar')->guessExtension();
					$img = \Image::make($request->file('avatar'))->fit(200, 200)->save($destination.$filename);
				}
			}

			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->phone = $request->input('phone');
			$user->department = $request->input('department');
			$user->avatar = $filename;
			$user->save();

			$rsRole = Role::find($request->input('roles'));
			$rsUser = User::find($user->id)->attachRole($rsRole);
			$results->status = 1;

		   }else{
				$results->status = 0;
				$results->info = 'users management';
				$message = array();

				foreach($validator->errors()->all() as $m){
					array_push($message, $m);
				}
				$results->message = $message;
			}
		}

		return response()->json($results);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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

	public function login(){
		$result1 = DB::table('parent_menu')->get();
		
		$datanyah = DB::table('parent_frontpage')->get();
		$siteTitle = Setting::where('name', 'title')->get();
		if( count($siteTitle) > 0){
			$bah = $siteTitle->first()->value;
		}else{
			$bah = 'Website';
		}
		return view('frontend.login', compact('result1', 'bah', 'datanyah'));
	}

	public function postLogin(Request $requests){
		$name = $requests->input('username');
		$password = $requests->input('password');

		if(\Auth::attempt(['email'=>$name, 'password'=>$password])){
			return redirect()->route('admin.dashboard.get');
		}else{
			return redirect()->route('users.login.get');
		}
	}
}
