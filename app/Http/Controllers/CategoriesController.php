<?php

namespace App\Http\Controllers;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = category::paginate(10);

        return view('categories.index', [
            'categories'=> $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create',[
            'categories'=> category::all()->where('parent_id', 0)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category-name'=>'required' ,
            'category-parent_id'=>['required','integer']
        ]);
        // DB::table('categories')->insert([
        //     'name'=>$request->name,
        //     'parent_id'=>$request->parent_id
        // ]);
        // return response('done');

        $category = new category();

        $category->name = strip_tags($request->input('category-name')) ;
        $category->parent_id = strip_tags($request->input('category-parent_id')) ;

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $categories = category::onlyTrashed()->get();
        // return $categories ;

        return view('categories.show', [
            'categories'=> category::onlyTrashed()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category)
    {
        return view('categories.edit', [
            'category'=> category::findOrFail($category)
        ]);
        // $category = DB::table('categories')->where('id', $id)->first();
        // return view('categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category)
    {
        $request->validate([
            'category-name'=>'required' ,
            'category-parent_id'=>['required','integer']
        ]);

        $to_update = category::findOrFail($category);

        $to_update->name = strip_tags($request->input('category-name')) ;
        $to_update->parent_id = strip_tags($request->input('category-parent_id')) ;

        $to_update->save();

        return redirect()->route('categories.show', $category);

        // DB::table('categories')->update([
        //     'name'=>$request->name,
        //     'parent_id'=>$request->parent_id
        // ]);
        // return response('done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category)
    {
        $to_delete = category::findOrFail($category);
        // $to_delete->delete();
        $to_delete->delete_all_child($to_delete);

        // $deleted = DB::table('categories')->where('id', $category)->delete();
        // $deleted = DB::table('categories')->where('parent_id', $category)->delete();


        return redirect()->route('categories.index', $category);

        /*
        DB::table('categories')->where('id', $id )->delete();
        */
    }

    public function restore($id) {
        $category = category::onlyTrashed()->where('id', $id)->restore();

        return redirect()->back();
    }

    public function forceDelete($id) {
        $category = category::onlyTrashed()->where([['id', $id],['parent_id', $id]])->forceDelete();

        return redirect()->back();
    }
}
