@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Locations</h1>

        <a class="btn btn-success" href="{{ route('locations.create') }}">+ Create</a>
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
                        <th scope="col">City</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <th scope="row">{{ $location->id }}</th>
                            <td>{{ $location->city  }}</td>
                            <td>{{ $location->created_at }}</td>
                            <td>
                                <a href="{{ route('locations.edit', ['location' => $location->id]) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('locations.gallery', ['location' => $location->id]) }}" class="btn btn-info">Gallery</a>
                                <a href="{{ route('locations.slider', ['location' => $location->id]) }}" class="btn btn-info">Slider</a>
                                <button class="btn btn-danger delete" data-id="{{ $location->id }}">Delete</button>
                                <a href="{{ route('places.index', ['location_id' => $location->id]) }}" class="btn btn-warning">Places</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$locations->count())
                    <p class="text-center">No items created..</p>
                @endif

                {{ $locations->links() }}
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
                    url: "locations/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
