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
                  <div class="card">
                    <div class="card-body p-0">
                      <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: auto">
                        <table class="table table-striped mb-0">
                            @if (count($news) > 0)
                                <thead style="background-color: #748094;">
                                    <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">categories</th>
                                    <th scope="col">image</th>
                                    <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($news as $single)
                                            <tr>
                                            <td>{{ $single['title'] }}</td>
                                            <td><p>{!! html_entity_decode($single['content']) !!}</p></td>

                                            <td>
                                                @foreach ($single->categories as $category)
                                                    {{ $category->name }}<br>
                                                @endforeach
                                            </td>
                                            <td><img src="{{asset('app\public\\'.$single->image)}}"></td>
                                            <td>
                                                <a href="{{route('news.edit', $single->id)}}" class="">edit</a>
                                                <form action="{{route('news.destroy', $single->id)}}" class="delete-btn" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-outline-danger" type="submit" value="delete">
                                                </form>
                                            </td>
                                            </tr>
                                        @endforeach
                            @else
                                        <p>there is no News to display</p>
                                </tbody>
                            @endif
                        </table>
                        <br>
                        <div>
                            <a class="btn btn-lg btn-primary btn-block" href="{{route('news.create')}}">create</a>
                        </div>
                      </div>
                    </div>
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
    </div>--}}
</div>
@endsection
