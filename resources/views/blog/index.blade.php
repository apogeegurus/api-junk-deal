@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Blog</h1>

        <a class="btn btn-success" href="{{ route('blogs.create') }}">+ Create</a>
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
                        <th scope="col">Headline</th>
                        <th scope="col">Author</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <th scope="row">{{ $blog->id }}</th>
                                <td>{{ $blog->headline }}</td>
                                <td>{{ $blog->author }}</td>
                                <td>{{ $blog->created_at }}</td>
                                <td>
                                    <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}" class="btn btn-warning">Show</a>
                                    <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-danger delete" data-id="{{ $blog->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(!$blogs->count())
                    <p class="text-center">No items created..</p>
                @endif

                {{ $blogs->links() }}
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
                    url: "blogs/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
