<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaticController extends Controller
{
    public function index () {
        return view('welcome',[
            'categories'=> category::all()->where('parent_id', 0)
        ]);
    }
    public function logout () {
        return view('logout');
    }
    public function category () {
        return view('category');
    }
    public function news () {
        return view('news');
    }
    public function guset ($id) {

        $category = DB::table('categories')->leftJoin('news_categories','id','category_id')->where('id',$id)->select('news_id')->get();
        $category_name = category::find($id);
        $news_id = [];
        foreach($category as $item){
            $news_id[] = $item->news_id ;
        }
        $news = DB::table('news')->select('*')->whereIn('id',$news_id)->get() ;
        return view('guset.guset',[
            'news'=>$news,
            'categories'=> category::all()->where('parent_id', 0),
            'category_name'=> $category_name->name.' news'
        ]) ;


    }
    public function single_news ($id) {
        $news = news::find($id) ;
        return view('guset.single_news',[
            'news'=>$news,
            'categories'=> category::all()->where('parent_id', 0),
        ]) ;


    }
}

