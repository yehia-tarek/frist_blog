@extends('layouts.app')

{{-- title --}}
@section('title', 'news')

{{-- dropdown news for guest --}}
@section('news_for_guest')
    <li class="nav-item dropdown" id="myDropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">News Categories</a>
        <ul class="dropdown-menu">
            @foreach ($categories as $category)
                <li> <a class="dropdown-item" href="{{ route('home.guset', $category->id) }}">{{ $category->name }} &raquo;
                    </a>
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
    <main>
        <section class="text-center">
            <h4 class="mb-5"><strong>{{ $category_name }}</strong></h4>
        </section>
        <div class="album py-5 bg-light">
            <div class="container text-center">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                    @foreach ($news as $single)
                        <div class="col">
                            <div class="card shadow-sm">
                                {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="{{asset('app\public\\'.$single->image)}}" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}
                                <img src="{{ asset('app\public\\' . $single->image) }}" alt="">
                                <div class="card-body ">
                                    <p class="card-text">{{ $single->title }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{ route('guset.single_news', $single->id) }}"
                                                class="btn btn-primary">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
