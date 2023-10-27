<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\news;
use App\Models\news_category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::with('categories')->get();

        return view('news.index', [
            'news'=> $news,
        ]);

        // $cat_name =[];
        // foreach($news as $single){
        //     foreach($single->categories as $category){
        //         $cat_name[$single->id] = $category->name;
        //     }
        // }


        // return view('news.index', [
        //     'news'=> news::all(),
        //     'categories'=>$cat_name
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = category::all();
        return view('news.create',[
            'categories'=>category::all()->where('parent_id', 0)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'news-title'=>'required' ,
        //     'news-content'=>'required',
        //     'news-category'=>'required'
        // ]);

        $image = $request->file('photo')->getClientOriginalName() ;
        $path = $request->file('photo')->storeAs('images', $image,'images') ;





        $news = new news();


        $news->title = strip_tags($request->input('news-title')) ;
        $news->content = htmlentities($request->input('news-content')) ;
        $news->image = $path ;
        $news->save();

        $category_id = $request->input('news-category');
        $news->categories()->attach($category_id);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $news)
    {
        return view('news.show', [
            'news'=> news::findOrFail($news)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $news)
    {
        return view('news.edit', [
            'news'=> news::findOrFail($news)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $news)
    {
        $request->validate([
            'news-title'=>'required' ,
            'news-content'=>'required'
        ]);

        $to_update = news::findOrFail($news);

        $to_update->title = strip_tags($request->input('news-title')) ;
        $to_update->content = strip_tags($request->input('news-content')) ;

        $to_update->save();

        return redirect()->route('news.index', $news);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $news)
    {
        $to_delete = news::findOrFail($news);
        $to_delete->delete();

        return redirect()->route('news.index', $news);
    }
}
