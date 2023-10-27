@extends('layout')

@section('title', 'show news')

@section('content')
<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="flex justify-center">
        <h1>news</h1>
    </div>

    <div class="mt-16">
        <p>{{ $news['name'] }} ( {{$news['origin']}} ) - <strong>{{$news['price']}}$</strong></p>
    </div>
    <a href="{{route('news.edit', $news->id)}}" class="edit-btn">edit</a>
    <form action="{{route('news.destroy', $news->id)}}" class="delete-btn" method="post">
        @csrf
        @method('DELETE')
        <input class="delete-btn" type="submit" value="delete">
    </form>

</div>
@endsection
