@extends('layouts.app')

@section('title', 'create news')

@section('content')
    <div class="container">
        <div class="flex justify-center text-center">
            <h1>edit a old news</h1>
        </div>
        {{-- <div class="row justify-content-center">
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
    </div> --}}
        <div class="row justify-content-center">
            <form action="{{ route('news.update', ['news' => $news->id]) }}" method="post" class="form bg-white p-6 border-1" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="news-title" class="form-label">news title :</label>
                    <input id="news-title" name="news-title" value="{{ $news->title }}" type="text"
                        class="text-lg border-1 form-control">
                    @error('news-title')
                        <div class="form-error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="news-content" class="form-label mt-3">news content :</label>
                    {{-- <textarea name="news-content" id="news-content" value="{{ old('news-content') }}"></textarea> --}}
                    <div class="form-floating">
                        <textarea class="form-control" name="news-content">{{ $news->content }}</textarea>
                    </div>
                    @error('news-content')
                        <div class="form-error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="news-title" class="form-label">categories :</label>
                    <input id="news-title" value="{{ $news->categories->pluck('name') }}" type="text"
                        class="text-lg border-1 form-control" disabled>
                </div>
                <div class="form-check mt-3 mb-3 border rounded p-0">
                    <div class="no_center">
                        <label for="news-content" class="form-label ps-3 d-block border rounded mb-0">select categories
                            :</label>
                        @foreach ($categories as $category)
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input type="checkbox" class="form-check-input ms-1" name="news-category[]"
                                        value="{{ $category->id }}" id="{{ $category->name }}">
                                    <label class="form-check-label ms-1"
                                        for="{{ $category->name }}">{{ $category->name }}</label>
                                    <ul>
                                        @include('categories.child', [
                                            'childs' => $category->childs,
                                            'level' => 1,
                                            'action' => 'checkbox',
                                        ])
                                    </ul>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                    @error('news-category')
                        <div class="form-error text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <img class="img-fluid w-25 mb-3" src="{{ asset('app\public\\' . $news->image) }}">
                </div>
                <div>
                    <input type="file" class="form-control" name="photo">
                </div>
                <div>
                    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
