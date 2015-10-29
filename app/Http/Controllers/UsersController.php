<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Controllers\PagesController;
use Auth;

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
		return view('_layout.form.form-input-user-backend', compact('nip', 'phone','avatar','jabatan','name','email', 'idnyah','resultRole', 'roles'));
	}

	public function showAll(){
		$result = User::All();
		$sBa = $this->getPermission('2');
		$sBe = $this->getPermission('3');
		$sBd = $this->getPermission('4');

		return view('_layout.tabel.tabel-user', compact('result','sBa','sBe','sBd'));
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

		if(!$request->has('id')){
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
			$user->jabatan = $request->input('department');
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

	public function login(){
		$result1 = DB::table('parent_menu')->get();

		$datanyah = DB::table('parent_frontpage')->get();
		$title = Setting::where('name', 'title')->get();
		if( count($title) > 0){
			$title = $title->first()->value;
		}else{
			$title = 'Login Page';
		}
		$bg = Setting::where('name', 'background')->get();
        if( count($bg) > 0){
            $bg = asset('/uploads/background/') . '/' .$bg->first()->value;
        }else{
            $bg = 'assets/img/bg.jpg';
        }
        $siteTitle = Setting::where('name', 'title')->get();
        if( count($siteTitle) > 0){
            $bah = $siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }
        $footer = Setting::where('name', 'footer')->get();
        if( count($footer) > 0){
            $footer = $footer->first()->value;
        }else{
            $footer = '(c) 2015, Ordent, All Right Reserved.';
        }
		return view('frontend.login', compact('result1', 'title', 'datanyah', 'bg', 'bah', 'footer'));
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
		}

		return redirect()->to('/');
	}

	public function getPermission($mode){

		$sB = new \StdClass;
		$sB->dashboard = false;
		$sB->menu_user = false;
		$sB->user = false;
		$sB->role = false;
		$sB->permission = false;
		$sB->menu = false;
		$sB->module = false;
		$sB->gambar = false;
		$sB->preference = false;

		$id_user = Auth::User()->id;
		$role = DB::table('roles')->get();
		foreach($role as $rolerS){
			if(User::find($id_user)->hasRole($rolerS->name)==1){
				$userRole = $rolerS->name;
				$role_id = $rolerS->id;
			}
		}

		$resultPermission = DB::table('permission_role')
						->join('permissions', 'permissions.id' , '=' , 'permission_role.permission_id')
						->join('roles', 'roles.id' , '=' , 'permission_role.role_id')
						->join('modules', 'modules.id', '=', 'permission_role.action')
						->select('permission_role.permission_id as pID', 'permission_role.role_id as rID',
										'roles.display_name as role_dn', 'permissions.name as per_name',
										'permissions.display_name as per_dn', 'permission_role.action as action',
										'permission_role.access as access', "modules.name as module_name",
										'modules.id as mID')
						->where('permission_role.role_id', $role_id)
						->where('permission_role.permission_id', $mode) //Permission Dapat Melihat
						->get(); //->toSql();

		foreach($resultPermission as $rsP){
			switch($rsP->module_name){
				case "Backend Dashboard": $sB->dashboard = true; break;
				case "Backend User": $sB->user = true; $sB->menu_user=true; break;
				case "Backend Role": $sB->role = true; $sB->menu_user=true;break;
				case "Backend Permission": $sB->permission = true; $sB->menu_user=true; break;
				case "Backend Menu": $sB->menu = true; break;
				case "Backend Module": $sB->module = true; break;
				case "Backend Gambar": $sB->gambar = true; break;
				case "Backend Preference": $sB->preference = true; break;
				case "All Module":
					$sB->dashboard = true;
					$sB->menu_user = true;
					$sB->user = true;
					$sB->role = true;
					$sB->permission = true;
					$sB->menu = true;
					$sB->module = true;
					$sB->gambar = true;
					$sB->preference = true;
				break;
			}
		}

		return $sB;
	}
}
