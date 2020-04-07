@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home Page</h1>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    Successfully updated.
                </div>
            @endif

            <form action="{{ route('pages.home.update', ['id' => $home->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $home->title ?? old('title') }}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_title">Sub Title</label>
                    <textarea class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" name="sub_title">{{ $home->sub_title ?? old('sub_title') }}</textarea>
                    @error('sub_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="specialize_title">Specialize title</label>
                    <textarea class="form-control @error('specialize_title') is-invalid @enderror" id="specialize_title" name="specialize_title">{{ $home->specialize_title ?? old('specialize_title') }}</textarea>
                    @error('specialize_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="banner_one_text">First Banner Text</label>
                    <textarea class="form-control @error('banner_one_text') is-invalid @enderror" id="banner_one_text" name="banner_one_text">{{ $home->banner_one_text ?? old('banner_one_text') }}</textarea>
                    @error('banner_one_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="banner_two_text">Second Banner Text</label>
                    <textarea class="form-control @error('banner_two_text') is-invalid @enderror" id="banner_two_text" name="banner_two_text">{{ $home->banner_two_text ?? old('banner_two_text') }}</textarea>
                    @error('banner_two_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="how_it_works_title">How it works Title</label>
                    <textarea class="form-control @error('how_it_works_title') is-invalid @enderror" id="how_it_works_title" name="how_it_works_title">{{ $home->how_it_works_title ?? old('how_it_works_title') }}</textarea>
                    @error('how_it_works_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="how_it_works_sub_title">How it works Sub Title</label>
                    <textarea class="form-control @error('how_it_works_sub_title') is-invalid @enderror" id="how_it_works_sub_title" name="how_it_works_sub_title">{{ $home->how_it_works_sub_title ?? old('how_it_works_sub_title') }}</textarea>
                    @error('how_it_works_sub_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="step_1_text">Step 1</label>
                    <textarea class="form-control @error('step_1_text') is-invalid @enderror" id="step_1_text" name="step_1_text">{{ $home->step_1_text ?? old('step_1_text') }}</textarea>
                    @error('step_1_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="step_2_text">Step 2</label>
                    <textarea class="form-control @error('step_2_text') is-invalid @enderror" id="step_2_text" name="step_2_text">{{ $home->step_2_text ?? old('step_2_text') }}</textarea>
                    @error('step_2_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="step_3_text">Step 3</label>
                    <textarea class="form-control @error('step_3_text') is-invalid @enderror" id="step_3_text" name="step_3_text">{{ $home->step_3_text ?? old('step_3_text') }}</textarea>
                    @error('step_3_text')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="video_title">Video Title</label>
                    <textarea class="form-control @error('video_title') is-invalid @enderror" id="video_title" name="video_title">{{ $home->video_title ?? old('video_title') }}</textarea>
                    @error('video_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Banner First</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bannerFirst" aria-describedby="inputGroupFileAddon02" name="banner_first" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>
                    </div>
                    <div id="bannerFirstPreview">
                        <img src="{{ $home->banner_first_path }}" alt="">
                        @if($home->banner_first_path)
                            <input type="hidden" name="bannerFirstUploaded" value="{{ $home->banner_first_path }}">
                        @endif
                    </div>

                    @error('banner_first')
                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label>Banner Second</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bannerSecond" aria-describedby="inputGroupFileAddon03" name="banner_second" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div>
                    </div>
                    <div id="bannerSecondPreview">
                        <img src="{{ $home->banner_second_path }}" alt="">
                        @if($home->banner_second_path)
                            <input type="hidden" name="bannerSecondUploaded" value="{{ $home->banner_second_path }}">
                        @endif
                    </div>

                    @error('banner_second')
                    <span class="text-danger" role="alert">
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
    <script type="text/javascript">
        function readURL(file) {
            return new Promise((resolve, reject) => {
                var reader = new FileReader();
                reader.onload = function (e) {resolve(e.target.result);};
                reader.onerror = function() {reject};
                reader.readAsDataURL(file);
            });
        }


        $('#bannerFirst').change(function () {
            $('#bannerFirstPreview').html('');
            readURL(this.files[0]).then(url => {
                $('#bannerFirstPreview').append(`<img src="${url}"  alt=""/>`);
            })
        })

        $('#bannerSecond').change(function () {
            $('#bannerSecondPreview').html('');
            readURL(this.files[0]).then(url => {
                $('#bannerSecondPreview').append(`<img src="${url}"  alt=""/>`);
            })
        })

    </script>
@endpush

