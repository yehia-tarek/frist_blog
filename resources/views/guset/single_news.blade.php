@extends('layouts.app')

{{-- title --}}
@section('title', 'news')

{{-- dropdown news for guest --}}
@section('news_for_guest')
    <li class="nav-item dropdown" id="myDropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">News Categories</a>
        <ul class="dropdown-menu">
            @foreach ($categories as $category)
                <li> <a class="dropdown-item" href="{{ route('home.guset', $category->id) }}">{{ $category->name }} news
                        &raquo; </a>
                    @if (count($category->childs))
                        @include('categories.child', [
                            'childs' => $category->childs,
                            'action' => 'category_list',
                        ])
                    @endif
                </li>
            @endforeach
        </ul>
    </li>
@endsection

{{-- content page --}}
@section('content')

    <div class="container p-3 border rounded">
        <div class="row">
            <div class="col-8">
                <h1 class="mb-1 text-bold">{{ $news->title }}</h1>
                <p class="">{!! html_entity_decode($news->content) !!}</p>
            </div>
            <div class="col-4 d-flex justify-content-end">

                <img src="{{ asset('app\public\\' . $news->image) }}" class="w-50">
            </div>
        </div>
    </div>


@endsection
