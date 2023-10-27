@extends('layouts.app')

@section('title', 'create category')

@section('content')
<div class="container text-center">
    {{-- <div class="flex justify-center">
        <h1>create a new category</h1>
    </div> --}}
    <div class="row justify-content-center">
        <div class="col-md-8 row justify-content-center" >
            <form action="{{route('categories.store')}}" method="post" class="form bg-white p-6 border-1 form-signin">
                @csrf
                <h3 class="text-center"><strong>Create</strong> category</h3>
                <div class="card-body ">
                    <label for="category-name" class="text-sm">category name</label>
                    <input id="category-name" name="category-name" value="{{old('category-name')}}" type="text" class="text-lg border-1 form-control" >
                    @error('category-name')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <br>
                {{-- <div>
                    <label for="category-parent_id" class="text-sm">category parent_id</label>
                    <input id="category-parent_id" name="category-parent_id" value="{{old('category-parent_id')}}" type="text" class="text-lg border-1" >
                    @error('category-parent_id')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div> --}}
                <div class="card-body">
                    <label for="category-parent_id" class="text-sm">category parent_id</label>
                    <select name="category-parent_id" id="category-parent_id">
                        <option value="0">none</option>
                        @foreach ( $categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @include('categories.child',['childs'=> $category->childs, 'level'=> 1, 'action'=>'select'])
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
