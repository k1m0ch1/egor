<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function form(Request $request){
        $as = $request->input('as');
        $rS = $as!="add"?DB::table('roles')->where('id', $request->input('id'))->get()->first():"";
        
        return view('_layout.form-role-backend', compact('rS', 'as'));
    }
}
