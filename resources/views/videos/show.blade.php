@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Show Video</h1>

        <a class="btn btn-success" href="{{ route('videos.index') }}">Videos</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Title:</b> {{ $video->title }}</li>
                <li class="list-group-item"><b>Description:</b> {{ $video->description }}</li>
                <li class="list-group-item"><b>Video:</b> {{ $video->video_url }}</li>
                <li class="list-group-item"><b>For Mobile:</b> {{ $video->is_mobile ? "Yes" : "No" }}</li>
                <li class="list-group-item"><b>Created At:</b> {{ $video->created_at }}</li>
            </ul>
        </div>
    </div>
@endsection
