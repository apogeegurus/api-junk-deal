@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service</h1>

        <a class="btn btn-success" href="{{ route('services.index') }}">Services</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Main Image:</b>
                    <img src="{{ $service->main_image_path }}" alt="" width="300px" class="d-block">
                </li>
                <li class="list-group-item"><b>Title:</b> {{ $service->title }}</li>
                <li class="list-group-item"><b>Sub Title:</b> {{ $service->sub_title }}</li>
                <li class="list-group-item"><b>Alt:</b> {{ $service->alt }}</li>
                <li class="list-group-item"><b>Short Description:</b> {{ $service->short_description }}</li>
                <li class="list-group-item"><b>Long Description:</b> {{ $service->long_description }}</li>
            </ul>
{{--needs to delete--}}
{{--            <div id="gallery--photos__upload">--}}
{{--                @foreach($service->gallery as $image)--}}
{{--                    <img src="{{ $image->path }}" alt="{{$image->alt}}">--}}

{{--                @endforeach--}}
{{--            </div>--}}
            <div style="display: flex">
                @foreach($service->gallery as $image)
                    <div class="gal_block" style="width: 15%;margin: 10px;border: 1px solid #ddd;" >
                        <img src="{{ $image->path }}" alt="{{$image->alt}}" style="width: 100%;height: 250px;object-fit: cover">
                        <p class="text-center">{{$image->alt}}</p>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
