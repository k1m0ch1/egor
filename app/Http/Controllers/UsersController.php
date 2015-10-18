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

        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
            $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

                if(!in_array(strtolower($extension), $allowed)){
                    $hasil = false;
                }

                if(move_uploaded_file($_FILES['avatar']['tmp_name'], public_path() . '/uploads/avatar/' .$_FILES['avatar']['name'])){
                    $hasil = true;
                    $avatar = $_FILES['avatar']['name'];
                }
            }else if($request->input('name')!=''){
                $hasil = true;
            }

            if($hasil){
                $as = $request->input('as');
                $rS = User::find($request->input('id'));
                $rS = $rS==null?new User:$rS;
                $rS->name = $request->input('name');
                $rS->email = $request->input('email');
                $rS->phone = $request->input('phone');
                $rS->department = $request->input('department');
                $rS->avatar = $avatar;
                if($as=="add"){ $rS->password = \Hash::make($request->input('password')); };
                echo var_dump($request->input('password'));
                $rS->save();
                $rsRole = Role::find($request->input('roles'));
                $rsUser = User::find($rS->id)->attachRole($rsRole);
            }

        return "success";
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
