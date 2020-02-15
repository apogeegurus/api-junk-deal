@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Team Members</h1>

        <a class="btn btn-success" href="{{ route('teams.create') }}">+ Create</a>
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
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                            <tr>
                                <th scope="row">{{ $team->id }}</th>
                                <td>
                                    <img src="{{ $team->avatar_path }}"  width="35px" height="35px" style="object-fit: cover"/>
                                </td>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->position }}</td>
                                <td>
                                    <a href="{{ route('teams.edit', ['team' => $team->id]) }}" class="btn btn-success">Edit</a>
                                    <button class="btn btn-danger delete" data-id="{{ $team->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if(!$teams->count())
                    <p class="text-center">No members created..</p>
                @endif

                {{ $teams->links() }}
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
                    url: "teams/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
