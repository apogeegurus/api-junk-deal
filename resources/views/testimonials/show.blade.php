@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>

        <a class="btn btn-success" href="{{ route('testimonials.index') }}">Testimonials</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Name:</b> {{ $testimonial->name }}</li>
                <li class="list-group-item"><b>Description:</b> {{ $testimonial->description }}</li>
                <li class="list-group-item"><b>Created At:</b> {{ $testimonial->created_at }}</li>
            </ul>
        </div>
    </div>
@endsection
