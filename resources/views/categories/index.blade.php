@extends('layouts.app')

@section('title', 'categories')

@section('content')
<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div class="text-center">
        <h3 >categories</h3>
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
                            @if (count($categories) > 0)
                                <thead style="background-color: #748094;">
                                    <tr>
                                    <th scope="col">Category name</th>
                                    <th scope="col">Parent Category</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                            <td>{{ $category['name'] }}</td>
                                            <td>{{ $category['parent_id'] }}</td>
                                            <td>
                                                <a href="{{route('categories.edit', $category->id)}}" class="">edit</a>
                                                <form action="{{route('categories.destroy', $category->id)}}" class="delete-btn" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-outline-danger" type="submit" value="delete">
                                                </form>
                                            </td>
                                            </tr>
                                        @endforeach
                            @else
                                        <p>there is no categories to display</p>
                                </tbody>
                            @endif
                        </table>
                        <br>
                        <div class="lead">
                            <a class="btn btn-lg btn-primary btn-block" href="{{route('categories.create')}}">create</a>
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
        @if (count($categories) > 0)
            <ul>
                @foreach ($categories as $category)
                    <a href="{{route('categories.show', ['category' => $category['id']])}}">
                        <li>
                            <p>{{ $category['name'] }}</p>
                        </li>
                    </a>
                @endforeach
            </ul>
        @else
            <p>there is no categories to display</p>
        @endif
    </div>
    <br> --}}

</div>
@endsection
