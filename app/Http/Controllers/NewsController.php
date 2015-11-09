<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Setting;
use DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = new \App\Http\Controllers\PagesController;
        $css = $pages->Css('general');
        $jH = $pages->jS('general');
        $title ='News';
        $sB = $pages->getDefault();
        $sBa = $pages->getDefault();
        $sBe = $pages->getDefault();
        $sBd = $pages->getDefault();
        $results = News::all();
        return view('backend.news', compact('css', 'jS','jH', 'title', 'a', 'rS', 'h', 'w', 'breadcrumb', 'footer', 'sB', 'sBa', 'sBe', 'sBd', 'results'));
    }

    public function frontendIndex(Request $request){
        $page = $request->input('page', 1);
        $limit = 20;
        $offset = (($page-1) * ($limit));
        $result = News::offset($offset)->take($limit)->get();

        $result1 = DB::table('parent_menu')->get();
        $siteTitle = Setting::where('name', 'title')->get();
        if( count($siteTitle) > 0){
            $bah = $siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }

        $footer = Setting::where('name', 'footer')->get();
        if( count($footer) > 0){
            $footer = $footer->first()->value;
        }else{
            $footer = '(c) 2015, Ordent, All Right Reserved.';
        }

        $logo = Setting::where('name', 'logo')->get();
        if( count($logo) > 0){
            $logo = asset('/uploads/logo/') . '/' .$logo->first()->value;
            $logo = preg_replace('/\s+/', '', $logo);
        }else{
            $logo = '#';
        }

        $count = ceil(count(News::all())/20);
        return view('frontend.news-index', compact('result', 'title', 'result1', 'footer', 'count','logo'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = new \App\Http\Controllers\PagesController;
        $css = $pages->Css('general');
        $jH = $pages->jS('general');
        $title ='News';
        $sB = $pages->getDefault();
        $sBa = $pages->getDefault();
        $sBe = $pages->getDefault();
        $sBd = $pages->getDefault();
        return view('backend.news-create', compact('css', 'jS','jH', 'title', 'a', 'rS', 'h', 'w', 'breadcrumb', 'footer', 'sB', 'sBa', 'sBe', 'sBd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = new News;
        $results->title = $request->input('title', 'Article');
        $results->slug = strtolower(str_replace(" ", "-", $results->title))."-".date('Ymd');
        $results->content = $request->input('content', 'Content');
        $results->category = $request->input('category', 'Category');
        if($request->hasFile('image')){
            $img = \Image::make($request->file('image'))->fit(960, 480);
            $name = date('YmdHis').str_pad(rand(0, 10000), 4,0,STR_PAD_RIGHT).".".str_replace("image/","",$img->mime());
            $img->save($results::UPLOAD_PATH."/".$name);
            $results->image = $name;
        }
        if(\Auth::check()){
            $results->author = \Auth::user()->id;
        }else{
            $results->author = 1;
        }

        $results->save();

        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = News::find($id);
        if(is_null($result)){
            $result = News::where('slug', $id)->get()->first();
        }
        $title = $result->title;

        $result1 = DB::table('parent_menu')->get();
        $siteTitle = Setting::where('name', 'title')->get();
        if( count($siteTitle) > 0){
            $bah = $siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }

        $footer = Setting::where('name', 'footer')->get();
        if( count($footer) > 0){
            $footer = $footer->first()->value;
        }else{
            $footer = '(c) 2015, Ordent, All Right Reserved.';


        }
        return view('frontend.news-show', compact('result', 'title', 'result1', 'footer'));
    }

     public function frontendShow($id)
    {
        $result = News::find($id);
        if(is_null($result)){
            $result = News::where('slug', $id)->get()->first();
        }
        $title = $result->title;

        $result1 = DB::table('parent_menu')->get();
        $siteTitle = Setting::where('name', 'title')->get();
        if( count($siteTitle) > 0){
            $bah = $siteTitle->first()->value;
        }else{
            $bah = 'Website';
        }

        $footer = Setting::where('name', 'footer')->get();
        if( count($footer) > 0){
            $footer = $footer->first()->value;
        }else{
            $footer = '(c) 2015, Ordent, All Right Reserved.';


        }
        return view('frontend.news-show', compact('result', 'title', 'result1', 'footer'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = new \App\Http\Controllers\PagesController;
        $css = $pages->Css('general');
        $jH = $pages->jS('general');
        $title ='News';
        $sB = $pages->getDefault();
        $sBa = $pages->getDefault();
        $sBe = $pages->getDefault();
        $sBd = $pages->getDefault();
        $result = News::find($id);
        return view('backend.news-create', compact('css', 'jS','jH', 'title', 'a', 'rS', 'h', 'w', 'breadcrumb', 'footer', 'sB', 'sBa', 'sBe', 'sBd', 'result'));
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
        $results = News::find($id);
        $results->title = $request->input('title', 'Article');
        $results->slug = strtolower(str_replace(" ", "-", $results->title))."-".date('Ymd');
        $results->content = $request->input('content', 'Content');
        $results->category = $request->input('category', 'Category');
        if($request->hasFile('image')){
            $img = \Image::make($request->file('image'))->fit(960, 480);
            $name = date('YmdHis').str_pad(rand(0, 10000), 4,0,STR_PAD_RIGHT).".".str_replace("image/","",$img->mime());
            $img->save($results::UPLOAD_PATH."/".$name);
            $results->image = $name;
        }
        if(\Auth::check()){
            $results->author = \Auth::user()->id;
        }else{
            $results->author = 1;
        }

        $results->save();

        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = News::find($id);
        if(!is_null($result)){
            $result->delete();
        }
        return redirect()->route('admin.news.index');
    }
}
