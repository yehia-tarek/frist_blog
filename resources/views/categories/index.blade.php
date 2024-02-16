@extends('layouts.app')

@section('title', 'categories')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="text-center">
            <h3>categories</h3>
        </div>
        <section class="intro">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="lead">
                                        <a class="btn btn-lg btn-primary btn-block"
                                            href="{{ route('categories.create') }}">create</a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-0">

                                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true"
                                            style="position: relative; height: auto">
                                            <table class="table table-striped mb-0 text-center">
                                                @if (count($categories) > 0)
                                                    <thead>
                                                        <tr class="row">
                                                            <th class="col">Category name</th>
                                                            <th class="col">Parent Category</th>
                                                            <th class="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categories as $category)
                                                            <tr class="row">
                                                                <td class="col">{{ $category['name'] }}</td>
                                                                <td class="col">{{ $category['parent_id'] }}</td>
                                                                <td class="col">
                                                                    <div>
                                                                        <a class="btn btn-primary"
                                                                            href="{{ route('categories.edit', $category->id) }}">edit</a>
                                                                        <form
                                                                            action="{{ route('categories.destroy', $category->id) }}"
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
                                                        <p>there is no categories to display</p>
                                                    </tbody>
                                                @endif
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <div class="">
                                    {{ $categories->links('vendor.pagination.bootstrap-4') }}
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
                        <a href="{{ route('categories.show', ['category' => $category['id']]) }}">
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
