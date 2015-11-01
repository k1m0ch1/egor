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
		$nip = "";
		$department = "";
		$idnyah = "xxx";
		$resultRole = Role::All();
		if($request->input('as')!="add"){
			$result1 = User::find($request->input('id'));
				$name = $result1->name;
				$email = $result1->email;
				$avatar = $result1->avatar;
				$idnyah = $result1->id;
				$phone = $result1->phone;
				$jabatan = $result1->jabatan;
				$nip = $result1->nip;
				$roles = $result1->roles->first();
		}
		return view('_layout.form-input-user-backend', compact('nip', 'phone','avatar','jabatan','name','email', 'idnyah','resultRole', 'roles'));
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

		if($request->has('id') && $request->input('xxx')){
			//
			if($validator->passes()){
			$user = new User;
			$user->password = \Hash::make($request->input('password'));
			$results->info = 'users create';
			if($request->hasFile('avatar')){
				if($request->file('avatar')->isValid()){
					$filename = date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('avatar')->guessExtension();
					$img = \Image::make($request->file('avatar'))->fit(200, 200)->save($destination.'/'.$filename);
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
		}else{
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
						$img = \Image::make($request->file('avatar'))->fit(200, 200)->save($destination.'/'.$filename);
					}
				}
				$user->name = $request->input('name');
				$user->email = $request->input('email');
				$user->phone = $request->input('phone');
				$user->nip = $request->input('nip');
				$user->jabatan = $request->input('jabatan');
				$user->avatar = $filename;
				$user->save();

				$rsRole = Role::find($request->input('roles'));

				if(!$user->hasRole($rsRole->name)){
					$user->detachRoles($user->roles);
					$user = User::find($user->id)->attachRole($rsRole);
				}
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
	
	public function loginSso()
	{
		\Cas::authenticate();
		$api = new ApiController;
		$user = $api->_getUserAttributes(\Cas::getCurrentUser());
		$_user = User::where('username',$user->username)->first();
		if (!$_user) {
			$_user = new User;
			$_user->email = $user->email;
			$_user->nip = $user->nip;
			$_user->username = $user->username;
			$_user->save();
		}
		\Auth::login($_user);
		return redirect('/');
	}

	public function login(){
		$result1 = DB::table('parent_menu')->get();

		$datanyah = DB::table('parent_frontpage')->get();
		$title = Setting::where('name', 'title')->get();
		if( count($title) > 0){
			$title = $title->first()->value;
		}else{
			$title = 'Login Page';
		}
		return view('frontend.login', compact('result1', 'title', 'datanyah'));
	}

	public function postLogin(Request $requests){
		$name = $requests->input('username');
		$password = $requests->input('password');

		if(\Auth::attempt(['email'=>$name, 'password'=>$password])){
			return redirect()->route('admin.dashboard.get');
		}else{
			return redirect('login')->with('errors', 'Maaf anda harus login terlebih dahulu');
		}
	}

	public function logout(){
		if(\Auth::check()){
			$users = \Auth::user();
			\Auth::logout();
			\Cas::authenticate();
			unset($_SESSION['phpCAS']);
			\phpCAS::logout(['url'=>url()]);
		}

		return redirect()->to('/');
	}
}
