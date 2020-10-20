@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gallery</h1>

        <a class="btn btn-success" href="{{ route('locations.index') }}">Locations</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <form action="{{ route('locations.gallery.update', ['gallery' => $gallery->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label>Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mainImage" aria-describedby="inputGroupFileAddon01" name="file[]" multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div id="mainImageAvatar" class="d-flex justify-content-between flex-wrap">
                        <img src="{{ $gallery->path }}" />
                    </div>

                    @error('file')
                    <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <p>-OR-</p>

                <div class="form-group">
                    <label for="hex_code">HEX Code</label>
                    <input type="text" class="form-control @error('hex_code') is-invalid @enderror" id="hex_code" value="{{ old('hex_code', $gallery->hex_code) }}" name="hex_code">
                    @error('hex_code')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                @if($gallery->hex_code)
                <div style="width: 200px;height: 200px; background: {{ $gallery->hex_code }};border: 1px solid #eee;"></div>
                @endif

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection


@push('js')
    <script type="text/javascript">
        function readURL(file) {
            return new Promise((resolve, reject) => {
                var reader = new FileReader();

                reader.onload = function (e) {
                    resolve(e.target.result);
                };

                reader.onerror = function() {
                    reject
                };

                reader.readAsDataURL(file);
            });
        }


        $('#mainImage').change(function () {
            $('#mainImageAvatar').html('');
            let files = this.files;
            filesSize = files.length;
            for(let i = 0; i < filesSize; i++) {
                readURL(files[i]).then((urlImage) => {
                    $('#mainImageAvatar').append(`<img src="${urlImage}"  alt=""/>`);
                });
            }
        })
    </script>
@endpush
