@extends('layouts.app')

@section('title', 'news')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center text-center">
            <h3>news</h3>
        </div>
        <section class="intro">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="mb-3">
                                    <a class="btn btn-lg btn-primary btn-block" href="{{ route('news.create') }}">create</a>
                                </div>
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                            style="position: relative; height: auto">
                                            <table class="table table-striped mb-0 text-center">
                                                @if (count($news) > 0)
                                                    <thead>
                                                        <tr class="row">
                                                            <th class="col-2">Title</th>
                                                            <th class="col-3">Content</th>
                                                            <th class="col-3">categories</th>
                                                            <th class="col-2">image</th>
                                                            <th class="col-2">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($news as $single)
                                                            <tr class="row">
                                                                <td class="col-2">{{ $single['title'] }}</td>
                                                                <td class="col-3">
                                                                    <p>{!! html_entity_decode($single['content']) !!}</p>
                                                                </td>

                                                                <td class="col-3">
                                                                    @foreach ($single->categories as $category)
                                                                        {{ $category->name . ', ' }}
                                                                    @endforeach
                                                                </td>
                                                                <td class="col-2"><img class="img-fluid"
                                                                        src="{{ asset('app\public\\' . $single->image) }}">
                                                                </td>
                                                                <td class="col-2">
                                                                    <div>
                                                                        <a href="{{ route('news.edit', $single->id) }}"
                                                                            class="btn btn-primary">edit,
                                                                            {{ $single->id }}</a>
                                                                        <form
                                                                            action="{{ route('news.destroy', $single->id) }}"
                                                                            class="delete-btn d-inline m-2" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input class="btn btn-outline-danger"
                                                                                type="submit" value="delete">
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <p>there is no News to display</p>
                                                    </tbody>
                                                @endif
                                            </table>



                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    {{ $news->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- <div class="mt-16">
        @if (count($news) > 0)
            <ul>
                @foreach ($news as $news)
                    <a href="{{route('news.show', ['news' => $news['id']])}}">
                        <li>
                            {{-- <p>{{ $news['name'] }} ( {{$news['origin']}} ) - <strong>{{$news['price']}}$</strong></p> --}}
        {{-- </li>
                    </a>
                @endforeach
            </ul>
        @else
            <p>there is no news to display</p>
        @endif
    </div> --}}
    </div>
@endsection
