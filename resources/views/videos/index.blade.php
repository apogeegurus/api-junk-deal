@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Videos</h1>

        <a class="btn btn-success" href="{{ route('videos.create') }}">+ Create</a>
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
                        <th scope="col">Video Url</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $datum)
                        <tr>
                            <th scope="row">{{ $datum->id }}</th>
                            <td>{{ $datum->title }}</td>
                            <td>{{ $datum->video_url }}</td>
                            <td>
                                <a href="{{ route('videos.show', ['video' => $datum->id]) }}" class="btn btn-warning">Show</a>
                                <a href="{{ route('videos.edit', ['video' => $datum->id]) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger delete" data-id="{{ $datum->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$videos->count())
                    <p class="text-center">No items created..</p>
                @endif

                {{ $videos->links() }}
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
                    url: "videos/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
