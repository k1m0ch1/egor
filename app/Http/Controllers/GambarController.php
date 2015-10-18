<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){
        $allowed = array('png', 'jpg', 'gif');
        $hasil = '{"status":"error"}';

        if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

            $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                $hasil = '{"status":"error"}';
            }

            if(move_uploaded_file($_FILES['upl']['tmp_name'], '/var/www/html/egor/public/assets/img/uploaded/menu/' . '/' .$_FILES['upl']['name'])){
                $hasil = '{"status":"success"}';
            }
        }

        return $hasil;
    }

    public function BgUpload(Request $request){
        $allowed = array('png', 'jpg', 'gif');
        $hasil = '{"status":"error"}';

        if(isset($_FILES['upl-Bg']) && $_FILES['upl-Bg']['error'] == 0){

            $extension = pathinfo($_FILES['upl-Bg']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                $hasil = '{"status":"error"}';
            }

            if(move_uploaded_file($_FILES['upl-Bg']['tmp_name'], '/var/www/html/egor/public/assets/img/uploaded/background/' . '/' .$_FILES['upl-Bg']['name'])){
                $hasil = '{"status":"success"}';
            }
        }

        return $hasil;
    }

    public function LogoUpload(Request $request){
        $allowed = array('png', 'jpg', 'gif');
        $hasil = '{"status":"error"}';

        if(isset($_FILES['upl-Logo']) && $_FILES['upl-Logo']['error'] == 0){

            $extension = pathinfo($_FILES['upl-Logo']['name'], PATHINFO_EXTENSION);

            if(!in_array(strtolower($extension), $allowed)){
                $hasil = '{"status":"error"}';
            }

            if(move_uploaded_file($_FILES['upl-Logo']['tmp_name'], '/var/www/html/egor/public/assets/img/uploaded/logo/' . '/' .$_FILES['upl-Logo']['name'])){
                $hasil = '{"status":"success"}';
            }
        }

        return $hasil;
    }
}
