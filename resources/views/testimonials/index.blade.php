@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>

        <a class="btn btn-success" href="{{ route('testimonials.create') }}">+ Create</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($testimonials as $datum)
                        <tr>
                            <th scope="row">{{ $datum->id }}</th>
                            <td>{{ $datum->name }}</td>
                            <td>
                                <a href="{{ route('testimonials.show', ['testimonial' => $datum->id]) }}" class="btn btn-warning">Show</a>
                                <a href="{{ route('testimonials.edit', ['testimonial' => $datum->id]) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger delete" data-id="{{ $datum->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$testimonials->count())
                    <p class="text-center">We have no any result :(</p>
                @endif

                {{ $testimonials->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $('.delete').click(function () {
            let id = $(this).attr('data-id');
            let self = $(this);

            if(confirm('Are you sure want to delete this item?')) {
                $.ajax({
                    url: "testimonials/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
