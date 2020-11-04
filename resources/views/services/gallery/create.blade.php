@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gallery</h1>

        <a class="btn btn-success" href="{{ route('services.index') }}">Services</a>
    </div>
@endsection

@section('content')

    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <form action="{{ route('services.gallery.store', ['service' => request()->segment(2) ]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <div class="upload--block">
                        <input type="file" name="gallery[]" class="d-none" id="gallery" multiple accept="image/x-png,image/gif,image/jpeg">
                        <label for="gallery">
                            <i class="fas fa-upload"></i>
                            Please Select Gallery Images
                        </label>
                    </div>

                    @error('gallery')
                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div id="gallery--photos__upload"></div>
                </div>
                <div class="form-group">
                    <label for="alt">Alt</label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" value="{{ old('alt') }}" name="alt">
                    @error('alt')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>


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

        $("#gallery").change(function() {
            let gallerySection = $('#gallery--photos__upload');
            gallerySection.html('');
            let files = this.files;
            filesSize = files.length;
            for(let i = 0; i < filesSize; i++) {
                readURL(files[i]).then((urlImage) => {
                    gallerySection.append(`<img src="${urlImage}"  alt=""/>`);
                });
            }
        });
    </script>
@endpush
