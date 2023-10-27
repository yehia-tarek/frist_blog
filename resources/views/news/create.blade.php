@extends('layouts.app')

@section('title', 'create news')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        {{-- <div class="flex justify-center">
            <h1>create a new news</h1>
        </div> --}}
        <div class="row justify-content-center">
            <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data" class="form bg-white p-6 border-1">
                @csrf
                <h3 class="text-center"><strong>Create new </strong>news</h3>
                <div>
                    <label for="news-title" class="text-sm">news title</label>
                    <input id="news-title" name="news-title" value="{{old('news-title')}}" type="text" class="text-lg border-1 form-control" >
                    @error('news-title')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="news-content" class="text-sm">news content</label>
                    <textarea name="news-content" id="news-content" value="{{old('news-content')}}" cols="30" rows="10"></textarea>
                    {{-- <input id="news-content" name="news-content" value="{{old('news-content')}}" type="text" class="text-lg border-1 form-control" > --}}
                    @error('news-content')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                {{-- <div>
                    <label for="news-category" class="text-sm">news category id</label>
                    <input id="news-category" name="news-category" value="{{old('news-category')}}" type="text" class="text-lg border-1" >
                    @error('news-category')
                        <div class="form-error">
                            {{$message}}
                        </div>
                    @enderror
                </div> --}}
                {{-- <div>
                    <label for="news-category" class="text-sm">news-category</label>
                    <select name="news-category" id="news-category">
                        @foreach ( $categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @include('categories.child',['childs'=> $category->childs, 'level'=> 1, 'action'=>'select'])
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-check">
                    <div  class="no_center">
                        <label for="news-content" class="text-sm">select categories :-</label>
                        @foreach ( $categories as $category )
                            <ul>
                                <li>
                                <input type="checkbox" name="news-category[]" value="{{$category->id}}" id="{{$category->name}}">
                                <label for="{{$category->name}}">{{$category->name}}</label>
                                    <ul>
                                        @include('categories.child',['childs'=> $category->childs, 'level'=> 1, 'action'=>'checkbox'])
                                    </ul>
                                </li>
                            </ul>
                            @endforeach
                    </div>
                </div>
                <div>
                    <input type="file" name="photo">
                </div>
                <div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
