@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Location Places</h1>

        <a class="btn btn-success" href="{{ route('places.create') }}">+ Create</a>
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
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($places as $place)
                            <tr>
                                <th scope="row">{{ $place->id }}</th>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->address }}</td>
                                <td>
                                    <a href="{{ route('places.edit', ['place' => $place->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-danger delete" data-id="{{ $place->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(!$places->count())
                    <p class="text-center">No places created..</p>
                @endif

                {{ $places->links() }}
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
                    url: "places/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
