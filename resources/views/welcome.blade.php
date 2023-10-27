@extends('layouts.app')

@section('title', 'welcome')

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

@section('content')
{{-- <div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-center">
        <h1>Welcome us</h1>
    </div>

    <div class="mt-16">
        this is welcome page
    </div>
</div> --}}
<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">


    <main role="main" class="inner cover">
      <h1 class="cover-heading">Welcome to nwespaper</h1>
      <p class="lead">sign in for the best news.</p>
      <p class="lead">
        <a class="btn btn-lg btn-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
        <a class="btn btn-lg btn-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
      </p>
    </main>
@endsection
