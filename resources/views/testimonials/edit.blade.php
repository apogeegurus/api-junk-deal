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
            <form action="{{ route('testimonials.update', ['testimonial' => $testimonial->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $testimonial->name ?? old('name') }}" name="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $testimonial->description ?? old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>



                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
