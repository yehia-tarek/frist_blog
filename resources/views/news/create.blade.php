@extends('layouts.app')

@section('title', 'create news')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                <h1>create a news</h1>
            </div>
            <div class="row justify-content-center">
                <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data"
                    class="form bg-white p-6 border-1">
                    @csrf
                    <div class="form-group">
                        <label for="news-title" class="form-label">news title :</label>
                        <input id="news-title" name="news-title" value="{{ old('news-title') }}" type="text"
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
                            <textarea class="form-control"></textarea>
                        </div>
                        @error('news-content')
                            <div class="form-error text-danger">
                                {{ $message }}
                            </div>
                        @enderror
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
                        <input type="file" class="form-control" name="photo">
                    </div>
                    <div>
                        <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
