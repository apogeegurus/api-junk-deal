@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Backup</h1>
        <form action="{{ route('backup.db') }}">
            <button class="btn btn-success" type="submit">Backup Current DB</button>
        </form>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            <h5>Change DB with selected backup</h5>
            <form action="{{ route('backup.change') }}" method="POST" id="importBackup">
                @csrf

                <div class="form-group">
                    <label for="backup">Select Backup File</label>
                    <select id="backup" name="backup_file" class="form-control">
                        <option value="">Select File</option>
                        @foreach($backups as $backup)
                            <option value="{{ $backup['file_name'] }}">{{ $backup['file_name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-info update-db" type="button">Update DB</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <h5>Manage Backups</h5>
            <div class="table-responsive">
                <table class="table" style="table-layout: fixed">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <th scope="row">{{ ++$loop->index }}</th>
                            <td>{{ $backup['file_name'] }}</td>
                            <td class="text-right">
                                <button class="btn btn-danger delete" data-id="{{ $backup['file_name'] }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                    url: "backup/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('tr').remove();
                    }
                })
            }
        })

        $('.update-db').click(function () {
            if($('#backup').val() && confirm('Are you sure want to change current DB data?')) {
                $('#importBackup').submit();
            }
        })
    </script>
@endpush
