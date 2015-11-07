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

            if(move_uploaded_file($_FILES['upl']['tmp_name'], public_path() . '/uploads/menu/' . '/' .$_FILES['upl']['name'])){
                $hasil = '{"status":"success"}';
            }
        }

        return $hasil;
    }

    public function BgUpload(Request $request){
        $allowed = array('png', 'jpg', 'gif');
        $results = new \StdClass;

        $results->info = 'background upload';
        $results->status = 0;
        $results->message = 'Data Upload cant be completed.';


        if($request->hasFile('upl-Bg')){
            if($request->file('upl-Bg')->isValid()){
                $filename = 'bg-'.date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('upl-Bg')->guessExtension();
                $destination = Setting::BG_UPLOAD_PATH;
                $result = \Image::make($request->file('upl-Bg'))->fit(1920, 1080)->save($destination.$filename);
                $results->message = 'Data Upload has been completed.';
                $results->status = 1;
                $results->result = $filename;
            }
        }

        return response()->json($results);
    }

    public function LogoUpload(Request $request){
        $allowed = array('png', 'jpg', 'gif');
        $results = new \StdClass;

        $results->info = 'logo upload';
        $results->status = 0;
        $results->message = 'Data Upload cant be completed.';

         if($request->hasFile('upl-Logo')){
            if($request->file('upl-Logo')->isValid()){
                $filename = 'logo-'.date('YmdHis').str_pad(rand(0, 1000), 4, 0, STR_PAD_LEFT).'.'.$request->file('upl-Logo')->guessExtension();
                $destination = Setting::LOGO_UPLOAD_PATH;
                $result = \Image::make($request->file('upl-Logo'))->save($destination.$filename);
                $results->message = 'Data Upload has been completed.';
                $results->status = 1;
                $results->result = $filename;
            }
        }

        return response()->json($results);
    }

    public function uploadPath($id){
        $results = new \StdClass;
        $results->success = 1;
        $results->info = 'upload path get';
        
        if($id == 'background'){
            $results->result = Setting::BG_UPLOAD_PATH;
        }elseif($id == 'logo'){
            $results->result = Setting::LOGO_UPLOAD_PATH;
        }

        $hasil = DB::table('settings')->select('name', 'value')->where('name', 'background')
                            ->orWhere('name', 'logo')
                            ->get();

        $results->background =  $hasil[0]->value;
        $results->logo = $hasil[1]->value;

        return response()->json($results);
    }
}
