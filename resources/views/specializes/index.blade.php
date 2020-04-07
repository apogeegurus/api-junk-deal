@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Specialize</h1>

        <a class="btn btn-success" href="{{ route('specializes.create') }}">+ Create</a>
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
                        <th scope="col" class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($specializes as $specialize)
                        <tr>
                            <th scope="row">{{ $specialize->id }}</th>
                            <td>{{ $specialize->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('specializes.edit', ['specialize' => $specialize->id]) }}" class="btn btn-success">Edit</a>
                                <button class="btn btn-danger delete" data-id="{{ $specialize->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if(!$specializes->count())
                    <p class="text-center">No specialize created..</p>
                @endif

                {{ $specializes->links() }}
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
                    url: "specializes/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })
    </script>
@endpush
