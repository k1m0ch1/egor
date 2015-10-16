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
            
            $allowed = array('png', 'jpg', 'gif');
            $hasil = false;
            $image = 'holder.js/180x180';

            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

                $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                if(!in_array(strtolower($extension), $allowed)){
                    $hasil = false;
                }

                if(move_uploaded_file($_FILES['image']['tmp_name'], '/var/www/html/egor/public/assets/img/uploaded/' . '/' .$_FILES['image']['name'])){
                    $hasil = true;
                    $image = $_FILES['image']['name'];
                }
            }else if($request->input('nama')!=''){
                $hasil = true;
            }

            if($hasil){
                if($request->input('idnyah')!='xxx'){
                    DB::table('frontpage')->where('id', $request->input('idnyah'))->update(
                        ['nama' => $request->input('nama'),
                         'redirect' => $request->input('redirect'),
                         'image' => $image,
                         'mode' => $request->input('mode')]);
                }else{
                    DB::table('frontpage')->insert(
                       ['nama' => $request->input('nama'),
                         'redirect' => $request->input('redirect'),
                         'image' => $image,
                         'mode' => $request->input('mode')]);
                }
            }

        return "tes";
    }
}
