@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog</h1>

        <a class="btn btn-success" href="{{ route('blogs.index') }}">Blog</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Main Image:</b>
                    <img src="{{ $blog->main_image_path }}" alt="" width="300px" class="d-block">
                </li>
                <li class="list-group-item"><b>Headline:</b> {{ $blog->headline }}</li>
                <li class="list-group-item"><b>Sub Headline:</b> {{ $blog->sub_headline }}</li>
                <li class="list-group-item"><b>Author:</b> {{ $blog->author }}</li>
                <li class="list-group-item"><b>Description:</b> {!! $blog->description !!}</li>
            </ul>
        </div>
    </div>
@endsection
