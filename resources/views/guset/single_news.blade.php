@extends('layouts.app')

{{-- title --}}
@section('title', 'news')

{{-- dropdown news for guest --}}
@section('news_for_guest')
<li class="nav-item dropdown" id="myDropdown">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">News Categories</a>
    <ul class="dropdown-menu">
        @foreach ($categories as $category)
        <li> <a class="dropdown-item" href="{{ route('home.guset', $category->id) }}">{{$category->name}} news &raquo; </a>
            @if (count($category->childs))
                @include('categories.child',['childs'=> $category->childs, 'action'=>'category_list'])
            @endif
        </li>
        @endforeach
    </ul>
</li>
@endsection

{{-- content page --}}
@section('content')
{{-- <div class="container">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
        <h5 class="card-title">{{ $news->title }}</h5>
        <p class="card-text">{!! html_entity_decode($news->content) !!}</p>
        <img src="{{asset('app\public\\'.$news->image)}}" alt="">
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="p-5 mb-4 bg-light rounded-3">
        <img src="{{asset('app\public\\'.$news->image)}}" class="img-fluid img-thumbnail rounded float-end"  alt="">
        <div class="container-fluid py-5">
        <h1 class="blog-post-title mb-1">{{ $news->title }}</h1>
        <p class="col-md-8 fs-4">{!! html_entity_decode($news->content) !!}</p>
        </div>
    </div>
</div>

@endsection

{{-- <div class="container">

    <img src="{{asset('app\public\\'.$news->image)}}" class="img-fluid img-thumbnail rounded float-end"  alt="">

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $news->title }}</h3>
                </div>
                <div class="card-body">
                <p class="card-text">{!! html_entity_decode($news->content) !!}</p>
                </div>
            </div>
        </div>
</div>
</div> --}}


