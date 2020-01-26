@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Services</h1>

        <a class="btn btn-success" href="{{ route('services.create') }}">+ Create</a>
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
                        <th scope="col">Title</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <th scope="row">{{ $service->id }}</th>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>
                                    <a href="{{ route('services.show', ['service' => $service->id]) }}" class="btn btn-warning">Show</a>
                                    <a href="{{ route('services.edit', ['service' => $service->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-danger delete" data-id="{{ $service->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(!$services->count())
                    <p class="text-center">We have no any result :(</p>
                @endif

                {{ $services->links() }}
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
                    url: "services/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
