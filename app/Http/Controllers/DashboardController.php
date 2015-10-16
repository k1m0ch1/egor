<?php

namespace App\Http\Controllers;

use DB;
use File;
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
                    DB::table('parent_frontpage')->where('id', $request->input('idnyah'))->update(
                        ['nama' => $request->input('nama'),
                         'redirect' => $request->input('redirect'),
                         'image' => $image,
                         'mode' => $request->input('mode')]);
                }else{
                    DB::table('parent_frontpage')->insert(
                       ['nama' => $request->input('nama'),
                         'redirect' => $request->input('redirect'),
                         'image' => $image,
                         'mode' => $request->input('mode')]);
                }
            }

        return "tes";
    }

        public function formDashboard(Request $request){
            $parent_id = 'xxx';
            if($request->input('id')!='x'){
                $result1 = DB::table('parent_frontpage')->where('id', $request->input('id'))->get();
                foreach($result1 as $rS){
                    $nama = $rS->nama;
                    $redirect = $rS->redirect;
                    $image = $rS->image;
                    $id = $rS->id;
                    $mode = $rS->mode;
                }
                $files = File::files('/var/www/html/egor/public/assets/img/uploaded/');
                return view('_layout.form-input-dashboard-backend', compact('nama', 'redirect', 'image','files','id','mode','parent_id'));
            }else{
                return view('_layout.form-new-input-dashboard-backend', compact('parent_id'));
            }
        }

    public function delete(Request $request){
        $del = DB::table('parent_frontpage')->where('id', $request->input('id'))->delete();
        return $del==true?'success':'fail';
    }
}
