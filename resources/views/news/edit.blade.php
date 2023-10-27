@extends('layouts.app')

@section('title', 'create news')

@section('content')
<div class="container text-center">
    <div class="flex justify-center">
        <h1>edit a old news</h1>
    </div>
    <div class="row justify-content-center">
        <form action="{{route('news.update', ['news'=>$news->id])}}" method="post" class="form bg-white p-6 border-1">
            @csrf
            @method('PUT')
            <div>
                <label for="news-title" class="text-sm">news title</label>
                <input id="news-title" name="news-title" value="{{$news->title }}" type="text" class="text-lg border-1 form-control" >
                @error('news-title')
                    <div class="form-error">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div>
                <label for="news-content" class="text-sm">news content</label>
                <input id="news-content" name="news-content" value="{{$news->content }}" type="text" class="text-lg border-1 form-control" >
                @error('news-content')
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
