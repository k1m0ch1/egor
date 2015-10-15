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
            DB::table('frontpage')->where('id', $request->input('idnyah'))->update(
                ['nama' => $request->input('nama'),
                 'redirect' => $request->input('redirect'),
                 'image' => $request->input('image')]);
            //$fucka .= '' . $datanya[$a][1] . '' .$datanya[$a][0] . '<br/>';

        return 'success';
    }
}
