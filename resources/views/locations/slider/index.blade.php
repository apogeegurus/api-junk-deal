@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sliders</h1>

        <a class="btn btn-success" href="{{ route('locations.slider.create', ['location' => request()->segment(2)]) }}">+ Create</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <div id="gallery--photos__show">
                @foreach($sliders as $slider)
                    <div class="img-content" data-id="{{ $slider->id }}">
                        <img src="{{ $slider->path }}" alt="" height="200px" style="object-fit: cover">
                        <a class="delete-image d-block" data-id="{{ $slider->id }}">
                            <i class="fa fa-trash text-danger"></i>
                            Remove Image
                        </a>
                    </div>
                @endforeach
            </div>

            @if(!$sliders->count())
                <p class="text-center">No items created..</p>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $( "#gallery--photos__show" ).sortable({
            update: function(e, u) {
                const orders = [];
                $("#gallery--photos__show > div").each(function(key, item) {
                    orders.push($(item).attr("data-id"))
                })

                $.ajax({
                    url: "/locations/order/change/slider",
                    type: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        orders: orders
                    }
                })
            }
        });

        $('.delete-image').click(function () {
            let id = $(this).attr('data-id');
            let self = $(this);

            if(confirm('Are you sure want to delete this image?')) {
                $.ajax({
                    url: `/locations/images/${id}/slider`,
                    type: "DELETE",
                    success: function () {
                        self.closest('div.img-content').remove();
                    }
                })
            }
        })
    </script>
@endpush
