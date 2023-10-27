@extends('layouts.app')

@section('title', 'edit category')

@section('content')
<div class="container text-center">
    <div class="flex justify-center">
        <h2>edit a old category</h2>
    </div>
    <div class="row justify-content-center">
        <form action="{{route('categories.update', ['category'=>$category->id])}}" method="post" class="form bg-white p-6 border-1">
            @csrf
            @method('PUT')
            <div>
                <label for="category-name" class="text-sm">category name</label>
                <input id="category-name" name="category-name" value="{{$category->name }}" type="text" class="text-lg border-1 form-control" >
                @error('category-name')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div>
                <label for="category-parent_id" class="text-sm">category parent_id</label>
                <input id="category-parent_id" name="category-parent_id" value="{{$category->parent_id }}" type="text" class="text-lg border-1 form-control" >
                @error('category-parent_id')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <br>
            <div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
