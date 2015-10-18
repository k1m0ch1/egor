<?php

namespace App\Http\Controllers;

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
        $result1 = DB::table('users')->where('id', $request->input('id'))->get();
        foreach($result1 as $rS){
            $name = $rS->name;
            $email = $rS->email;
            $idnyah = $rS->id;
        }
        return view('_layout.form-input-user-backend', compact('name','email', 'idnyah'));
    }

    public function editSave(Request $request)
    {
        if($request->input('password')==""){
            DB::table('users')->where('id', $request->input('id'))->update(
                    ['name' => $request->input('name'),
                     'email' => $request->input('email')]);
        }else{
            DB::table('users')->where('id', $request->input('id'))->update(
                    ['name' => $request->input('name'),
                     'email' => $request->input('email'),
                     'password'=> Hash::make($request->input('password'))]);
        }
        return 'success';
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
            $bah = Setting::UPLOAD_PATH . '/' .$siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }
        return view('frontend.login', compact('result1', 'bah', 'datanyah'));
    }

    public function postLogin(Request $requests){
        $name = $requests->input('username');
        $password = $requests->input('password');

        if(\Auth::attempt(['name'=>$name, 'password'=>$password])){
            return redirect()->route('admin.dashboard.get');
        }else{
            return redirect()->route('users.login.get');
        }
    }
}
