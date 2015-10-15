<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use File;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $result1 = DB::table('parent_frontpage')->get();
        $siteTitle = DB::table('preference')->get();
        $datanyah = DB::table('frontpage')->get();
        $bah = $siteTitle[0]->title;
        return view('frontend.index', compact('result1', 'bah', 'datanyah'));
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
    public function show($id)
    {
        //
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

    public function dashboard(){
        $css = $this->CSS('general');
        $jH = $this->jS('general');
        $title = 'Dashboard';
        $rS = DB::table('preference')->get();
        $rS = $rS[0]->grid;
        $a=1;        
        return view('backend.dashboard', compact('css', 'jH', 'title', 'a', 'rS'));
    }

    public function indexGambar(){
        $css = $this->CSS('style-upload');
        $jH = $this->jS('image');
        $title = 'Dashboard';
        $files = File::files('/var/www/html/egor/public/assets/img/uploaded/');
        return view('backend.gambar', compact('css', 'jH', 'title','files'));
    }

    public function grid(Request $request){
        $a=0;
        $w=$request->input('w');
        $h=$request->input('h');
        $result1 = DB::table('frontpage')->orderBy('position', 'asc')->get();
        $img = Array();
        foreach($result1 as $rS){
            $img[$a][0] = $rS->nama;
            $img[$a][1] = $rS->position;
            $img[$a][2] = $rS->redirect;
            $img[$a][3] = $rS->image;
            $img[$a][4] = $rS->id;
            $a++;
        }
        $lenImg = sizeof($img);
        $a=0;
        return view('_layout.grid', compact('a','w','h', 'img', 'lenImg'));
    }

    public function formDashboard(Request $request){
        if($request->input('id')!='x'){
            $result1 = DB::table('frontpage')->where('id', $request->input('id'))->get();
            foreach($result1 as $rS){
                $nama = $rS->nama;
                $redirect = $rS->redirect;
                $image = $rS->image;
                $id = $rS->id;
                $mode = $rS->mode;
            }
            $files = File::files('/var/www/html/egor/public/assets/img/uploaded/');
            return view('_layout.form-input-dashboard-backend', compact('nama', 'redirect', 'image','files','id','mode'));
        }else{
            return view('_layout.form-new-input-dashboard-backend');
        }
    }

    public function user(){
        $title = 'Users';
        $css = $this->CSS('users');
        $jH =  $this->jS('general');
        $result = DB::table('users')->get();
        $a=0;
        return view('backend.user', compact('css', 'jH', 'title', 'result', 'a'));
    }

    public function tes(){
        $jH = Array( asset('holder.js') );
        $css = $this->CSS('general');
        $title = 'Tes';
        return view('backend.tes', compact('css', 'jH', 'title'));
    }

    public function menu(){
        $jH = Array( asset('holder.js') );
        $css = $this->CSS('menu');
        $title = 'Menu';
        $result1 = DB::select('SELECT child_frontpage.name as "ch_name" FROM parent_frontpage
                        INNER JOIN child_frontpage ON child_frontpage.id_parent = parent_frontpage.id');
        $result2 = $users = DB::table('parent_frontpage')->get();
        $a=1;
        return view('backend.menu', compact('css', 'jH', 'title', 'result1', 'result2', 'a'));
    }

    public function preference(){
        $jH = Array( asset('holder.js') );
        $css = $this->CSS('menu');
        $title = 'Preference';
        $result1 = DB::select('SELECT child_frontpage.name as "ch_name" FROM parent_frontpage
                        INNER JOIN child_frontpage ON child_frontpage.id_parent = parent_frontpage.id');
        $a=1;
        $result2 = DB::table('preference')->where('id', '1')->get();
        $files = File::files('/var/www/html/egor/public/assets/img/uploaded/');
        return view('backend.preference', compact('css', 'jH', 'title','result2','files'));
    }

    public function CSS($mode){
        $css = '';
        switch($mode){
            case 'general' :
                $css = Array(asset('assets/vendor/AdminLTE/bootstrap/css/bootstrap.min.css'),
                     'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
                     'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
                     asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                     asset('assets/vendor/AdminLTE/dist/css/skins/_all-skins.min.css'),
                     asset('assets/vendor/AdminLTE/plugins/iCheck/flat/blue.css'),
                     asset('assets/vendor/AdminLTE/plugins/morris/morris.css'),
                     asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css'),
                     asset('assets/vendor/AdminLTE/plugins/datepicker/datepicker3.css'),
                     asset('assets/vendor/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css'),
                     asset('assets/vendor/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'),
                     asset('assets/css/backend.css'),
                     "//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
                     asset('assets/css/image-picker.css')
                     );
            break;
            case 'users' :
                $css = Array(asset('assets/vendor/AdminLTE/bootstrap/css/bootstrap.min.css'),
                            'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
                            'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
                            "https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
                            asset('assets/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.css'),
                            asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                            asset('assets/vendor/AdminLTE/dist/css/skins/_all-skins.min.css'));
            break;
            case 'menu' :
                $css = Array("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css",
                             "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
                             "https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
                             asset('assets/vendor/AdminLTE/bootstrap/css/bootstrap.min.css'),
                             asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                             asset('assets/vendor/AdminLTE/dist/css/skins/_all-skins.min.css'),
                             asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                             asset('assets/css/image-picker.css'));
            break;
            case 'gridster' :
                $css = Array(asset('assets/vendor/AdminLTE/bootstrap/css/bootstrap.min.css'),
                     'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
                     'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
                     asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                     asset('assets/vendor/AdminLTE/dist/css/skins/_all-skins.min.css'),
                     asset('assets/vendor/AdminLTE/plugins/iCheck/flat/blue.css'),
                     asset('assets/vendor/AdminLTE/plugins/morris/morris.css'),
                     asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css'),
                     asset('assets/vendor/AdminLTE/plugins/datepicker/datepicker3.css'),
                     asset('assets/vendor/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css'),
                     asset('assets/vendor/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'),
                     asset('assets/css/backend.css'),
                     asset('assets/vendor/gridster/dist/jquery.gridster.css'));
            break;
            case 'style-upload' :
                $css = Array("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css",
                             "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
                             "https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css",
                             asset('assets/vendor/AdminLTE/bootstrap/css/bootstrap.min.css'),
                             asset('assets/vendor/AdminLTE/dist/css/AdminLTE.min.css'),
                             asset('assets/vendor/AdminLTE/dist/css/skins/_all-skins.min.css'),
                             asset('assets/css/style-upload.css'),
                             asset('assets/css/image-picker.css'));
            break;
        }
        return $css;
    }

    public function jS($mode){
        $JS = '';
        switch($mode){
            case 'general': 
            $JS = Array(asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js'),
                        "https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
                        asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js'),
                        "https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js",
                        //asset('assets/vendor/AdminLTE/plugins/morris/morris.min.js'),
                        asset('assets/vendor/gridster/dist/jquery.gridster.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/sparkline/jquery.sparkline.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                        asset('assets/vendor/AdminLTE/plugins/knob/jquery.knob.js'),
                        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js",
                        asset('assets/vendor/AdminLTE/plugins/daterangepicker/daterangepicker.js'),
                        asset('assets/vendor/AdminLTE/plugins/datepicker/bootstrap-datepicker.js'),
                        asset('assets/vendor/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js'),
                        asset('assets/vendor/AdminLTE/dist/js/app.min.js'),
                        asset('assets/js/dragAjah.js'),
                        asset('assets/js/tambahan.js'),
                        //asset('assets/vendor/AdminLTE/dist/js/pages/dashboard.js'),
                        asset('assets/vendor/AdminLTE/dist/js/demo.js'),
                        asset('assets/js/dashboard.js'),
                        asset('assets/vendor/foundation-5.5.3.custom/js/foundation.min.js'),
                        asset('assets/js/general.js'),
                        asset('holder.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/vendor/jquery.ui.widget.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/jquery.iframe-transport.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/jquery.fileupload.js'),
                        asset('assets/js/jquery.knob.min.js'),
                        asset('assets/js/image-picker.js'),
                        );
            break;
            case 'image':
            $JS = Array(asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js'),
                        "https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
                        asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js'),
                        "https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js",
                        //asset('assets/vendor/AdminLTE/plugins/morris/morris.min.js'),
                        asset('assets/vendor/gridster/dist/jquery.gridster.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/sparkline/jquery.sparkline.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                        asset('assets/vendor/AdminLTE/plugins/knob/jquery.knob.js'),
                        "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js",
                        asset('assets/vendor/AdminLTE/plugins/daterangepicker/daterangepicker.js'),
                        asset('assets/vendor/AdminLTE/plugins/datepicker/bootstrap-datepicker.js'),
                        asset('assets/vendor/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js'),
                        asset('assets/vendor/AdminLTE/dist/js/app.min.js'),
                        asset('assets/vendor/foundation-5.5.3.custom/js/foundation.min.js'),
                        asset('holder.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/vendor/jquery.ui.widget.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/jquery.iframe-transport.js'),
                        asset('assets/vendor/jQuery-File-Upload/js/jquery.fileupload.js'),
                        asset('assets/js/jquery.knob.min.js'),
                        asset('assets/js/upload.js'),
                        asset('assets/js/image-picker.js'),
                        );
            break;
        }
        return $JS;
    }
}
