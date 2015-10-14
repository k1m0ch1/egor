<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editSave(Request $request){
        $fileyah = $request->file('image');
        $nemfile = $fileyah->getClientOriginalName();
        $fileyah->move('/var/www/html/egor/public/assets/img/uploaded/', $nemfile);
        return 'lol';
    }
}
