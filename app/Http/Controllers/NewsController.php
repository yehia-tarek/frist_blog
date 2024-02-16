<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\news;
use App\Models\news_category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::with('categories')->paginate(10);

        return view('news.index', [
            'news'=> $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = category::all()->where('parent_id', 0);
        return view('news.create',[
            'categories'=> $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'news-title'=>'required' ,
            'news-content'=>'required',
            'news-category'=>'required'
        ]);

        $image = $request->file('photo')->getClientOriginalName().Carbon::now() ;
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
    public function edit($id)
    {
        $categories = category::all()->where('parent_id', 0);
        $news = news::where('id', $id)->with('categories')->first();

        return view('news.edit', [
            'categories'=> $categories,
            'news'=> $news,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $news)
    {
        $request->validate([
            'news-title'=>'required' ,
            'news-content'=>'required'
        ]);

        $to_update = news::findOrFail($news);

        if($request->file('photo')) {

            $old_image = $to_update->image ;
            $old_image_path = public_path('app/public/' . $old_image);
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }

            $image = $request->file('photo')->getClientOriginalName().Carbon::now() ;
            $path = $request->file('photo')->storeAs('images', $image,'images') ;
        }
        $to_update->title = strip_tags($request->input('news-title')) ;
        $to_update->content = strip_tags($request->input('news-content')) ;
        $to_update->image = $path ;

        $to_update->save();

        $category_id = $request->input('news-category');
        if ($category_id) {
            $to_update->categories()->sync($category_id);
        }

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
