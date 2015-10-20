<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use File;
use App\Models\Setting;
use App\Models\ParentFrontpage;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $result1 = DB::table('parent_menu')->get();
        $siteTitle = Setting::where('name', 'title')->get();
        if( count($siteTitle) > 0){
            $bah = $siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }

        $datanyah = ParentFrontpage::orderBy('position')->get();
        // Atur Grid Menu
        $h = Setting::where('name', 'grid_height')->get();
        if(count($h)>0){
            $h = $h->first()->value;
        }else{
            $h = 3;
        }

        $w = Setting::where('name', 'grid_width')->get();
        if( count($w) > 0 ){
           $w = $w->first()->value;
        }else{
           $w = 3;
        }

        $bg = Setting::where('name', 'background')->get();
        if( count($bg) > 0){
            $bg = asset('/uploads/background/') . '/' .$bg->first()->value;
        }else{
            $bg = 'assets/img/bg.jpg';
        }

        $footer = Setting::where('name', 'footer')->get();
        if( count($footer) > 0){
            $footer = $footer->first()->value;
        }else{
            $footer = '(c) 2015, Ordent, All Right Reserved.';
        }

        return view('frontend.index', compact('result1', 'bah', 'datanyah', 'h', 'w', 'bg', 'footer'));
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
        $breadcrumb = array(array('Home', 0), array('Dashboard', 1));
        $css = $this->CSS('general');
        $jH = $this->jS('general');

        $title = 'Dashboard';
        $a=1;

        // Atur Grid Menu
        $h = Setting::where('name', 'grid_height')->get();
        if(count($h)>0){
            $h = $h->first()->value;

        }else{
            $h = 3;
        }

        $w = Setting::where('name', 'grid_width')->get();
        if(count($w)>0){
           $w =$w->first()->value;

        }else{
           $w = 3;
        }

        $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }

        $rS = $w.'x'.$h;

        return view('backend.dashboard', compact('css', 'jH', 'title', 'a', 'rS', 'h', 'w', 'breadcrumb', 'footer'));
    }



    public function indexGambar(){
        $css = $this->CSS('style-upload');
        $jH = $this->jS('image');
        $title = 'Dashboard';
        $files = File::files(public_path(). '/uploads/menu/');

         $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }


        return view('backend.gambar', compact('css', 'jH', 'title','files', 'footer'));
    }

    public function fileList($id, Request $request){
        $dirSys = public_path() . '/' . $request->input('dir');
        $dir = $request->input('dir');
        $files = File::files($dirSys);

        $settings = \App\Models\Setting::where('name', $id)->get();
        if(count($settings)>0){
            $settings = $settings->first()->value;
        }else{
            $settings = 'nodata';
        }

        $idSelector = $request->input('idSelector');
        return view('_layout.file-list', compact('files', 'dir', 'idSelector', 'settings'));
    }

    public function grid(Request $request){
        $a=0;
        $w=$request->input('w');
        $h=$request->input('h');
        $result1 = DB::table('parent_frontpage')->orderBy('position', 'asc')->get();
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

    public function setGrid(Request $request){
        $w=$request->input('w');
        $h=$request->input('h');

        $result = Setting::where('name', 'grid_height')->get();

        if(count($result)>0){
            $result->first()->value = $h;
            $result->first()->save();
        }else{
            $result = new Setting;
            $result->name = 'grid_height';
            $result->value = $h;
            $result->save();
        }

        $result = Setting::where('name', 'grid_width')->get();
        if(count($result)>0){
            $result->first()->value = $w;
            $result->first()->save();
        }else{
            $result = new Setting;
            $result->name = 'grid_width';
            $result->value = $w;
            $result->save();
        }

        $results = new \StdClass;
        $results->info = "grid size set";
        $results->message = "Ukuran grid telah berhasil diubah.";
        $results->success = 1;
        $results->result = [$w, $h];
        return response()->json($results);
    }

    public function user(){
        $title = 'Users';
        $breadcrumb = array(array('Home', 0), array('User', 0), array('Users', 1));

        $css = $this->CSS('users');
        $jH =  $this->jS('users');
        $result = User::all();
        $a=0;

         $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }

        return view('backend.user', compact('css', 'jH', 'title', 'result', 'a', 'breadcrumb', 'footer'));
    }

     public function role(){
        $title = 'Role';
        $breadcrumb = array(array('Home', 0), array('User', 0), array('Roles', 1));
        $css = $this->CSS('users');
        $jH =  $this->jS('roles');
        $result = Role::all();
        $a=0;
         $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }
        return view('backend.role', compact('css', 'jH', 'title', 'result', 'a', 'breadcrumb', 'footer'));
    }

   public function permission(){
      $title = 'Permission';
      $breadcrumb = array(array('Home', 0), array('User', 0), array('Roles', 0), array('Permissions', 1));
      $css = $this->CSS('users');
      $jH =  $this->jS('permission');
      $result = Permission::all();
      $a=0;
       $footer = Setting::where('name', 'footer')->get();
      if(count($footer)>0){
         $footer =$footer->first()->value;
      }else{
         $footer = '(c) Ordent '.date('Y');
      }
      return view('backend.permission', compact('css', 'jH', 'title', 'result', 'a', 'breadcrumb', 'footer'));
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
        $result1 = DB::select('SELECT child_menu.name as "ch_name" FROM parent_menu
                        INNER JOIN child_menu ON child_menu.parent_id = parent_menu.id');
        $result2 = DB::table('parent_menu')->get();
        $a=1;

         $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }

        return view('backend.menu', compact('css', 'jH', 'title', 'result1', 'result2', 'a', 'footer'));
    }

    public function preference(){
        $css = $this->CSS('style-upload');
        $jH = $this->jS('image');
        $title = 'Preference';
        $result1 = DB::select('SELECT child_menu.name as "ch_name" FROM parent_menu
                        INNER JOIN child_menu ON child_menu.parent_id = parent_menu.id');
        $a=1;

        $result2 = count(Setting::where('name', 'title')->get())>0?Setting::where('name', 'title')->get()->first()->value:"";
        $result3 = count(Setting::where('name', 'footer')->get())>0?Setting::where('name', 'footer')->get()->first()->value:"";

        $filesLogo = File::files(public_path().'/'.\App\Models\Setting::LOGO_UPLOAD_PATH);
        $filesBg = File::files(public_path().'/'. \App\Models\Setting::BG_UPLOAD_PATH);

         $footer = Setting::where('name', 'footer')->get();
        if(count($footer)>0){
           $footer =$footer->first()->value;
        }else{
           $footer = '(c) Ordent '.date('Y');
        }

        return view('backend.preference', compact( 'css', 'jH', 'title','result2','result3','filesLogo','filesBg', 'footer'));
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
                             asset('assets/css/another-style-upload.css'),
                             asset('assets/css/another-another-style-upload.css'),
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
                        asset('assets/js/dialog-config.js'),
                        //asset('assets/vendor/AdminLTE/dist/js/pages/dashboard.js'),
                        asset('assets/vendor/AdminLTE/dist/js/demo.js'),
                        asset('assets/js/dashboard.js'),
                        asset('assets/vendor/foundation/js/foundation.min.js'),
                        asset('assets/js/general.js'),
                        asset('holder.js'),
                        asset('assets/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js'),
                        asset('assets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js'),
                        asset('assets/vendor/blueimp-file-upload/js/jquery.fileupload.js'),
                        asset('assets/js/jquery.knob.min.js'),
                        asset('assets/js/image-picker.js'),
                        asset('assets/vendor/simpleUpload/simpleUpload.js')
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
                        asset('assets/vendor/foundation/js/foundation.min.js'),
                        asset('holder.js'),
                        asset('assets/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js'),
                        asset('assets/vendor/blueimp-file-upload/js/jquery.iframe-transport.js'),
                        asset('assets/vendor/blueimp-file-upload/js/jquery.fileupload.js'),
                        asset('assets/js/jquery.knob.min.js'),
                        asset('assets/js/upload.js'),
                        asset('assets/js/image-picker.js'),
                        asset('assets/js/preferenceEvent.js'),
                        asset('assets/js/preference.js'),
                        );
            break;
            case "roles":
                $JS = Array(asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js'),
                        "https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
                        asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/jquery.dataTables.min.js'),
                        asset('assets/vendor/AdminLTE/dist/js/app.min.js'),
                        asset('assets/vendor/foundation/js/foundation.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js'),
                        asset('holder.js'),
                        asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js'),
                        //asset('assets/js/roleEvent.js'),
                        asset('assets/js/roleOperator.js')
                        );
            break;

            case "permission":
                $JS = Array(asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js'),
                        "https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
                        asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/jquery.dataTables.min.js'),
                        asset('assets/vendor/AdminLTE/dist/js/app.min.js'),
                        asset('assets/vendor/foundation/js/foundation.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js'),
                        asset('holder.js'),
                        asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js'),
                        //asset('assets/js/roleEvent.js'),
                        asset('assets/js/permissionOperator.js')
                        );
            break;

            case "users":
                $JS = Array(asset('assets/vendor/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js'),
                        "https://code.jquery.com/ui/1.11.4/jquery-ui.min.js",
                        asset('assets/vendor/AdminLTE/bootstrap/js/bootstrap.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/jquery.dataTables.min.js'),
                        asset('assets/vendor/AdminLTE/dist/js/app.min.js'),
                        asset('assets/vendor/foundation/js/foundation.min.js'),
                        asset('assets/vendor/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js'),
                        asset('holder.js'),
                        asset('assets/vendor/AdminLTE/plugins/fastclick/fastclick.min.js'),
                        //asset('assets/js/roleEvent.js'),
                        asset('assets/js/user_js.js')
                        );
            break;
        }
        return $JS;
    }
}
