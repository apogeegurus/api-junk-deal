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
                    <tbody id="sortable">
                    @foreach($specializes as $key => $specialize)
                        <tr data-id="{{ $specialize->id }}">
                            <th scope="row" class="id">{{ $key + 1 }}</th>
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
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $( "#sortable" ).sortable({
                update: function(e, u) {
                    const orders = [];
                    $("#sortable tr").each(function(key, item) {
                        orders.push($(item).attr("data-id"))
                    })

                    $.ajax({
                        url: "/specializes/order/change",
                        type: "POST",
                        data: {
                            _token: $("meta[name='csrf-token']").attr("content"),
                            orders: orders
                        }
                    })

                    $("#sortable tr").each(function(key, item) {
                        $(item).find(".id").text(key + 1);
                    })
                }
            });
        })

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
