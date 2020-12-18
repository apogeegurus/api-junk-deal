@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Services</h1>

        <a class="btn btn-success" href="{{ route('services.index') }}">Services</a>
    </div>
@endsection


@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}" name="title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_title">Sub Title</label>
                    <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" value="{{ old('sub_title') }}" name="sub_title">
                    @error('sub_title')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="long_description">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description">{{ old('long_description') }}</textarea>
                    @error('long_description')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Main Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mainImage" aria-describedby="inputGroupFileAddon01" name="mainImage">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div id="mainImageAvatar"></div>

                    @error('mainImage')
                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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


                <div class="form-group">
                    <label for="meta_description">Meta Description </label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" value="{{ old('meta_title') }}" name="meta_title">
                    @error('meta_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


{{--                <div class="form-group">--}}
{{--                    <div class="upload--block">--}}
{{--                        <input type="file" name="gallery[]" class="d-none" id="gallery" multiple accept="image/x-png,image/gif,image/jpeg">--}}
{{--                        <label for="gallery">--}}
{{--                            <i class="fas fa-upload"></i>--}}
{{--                            Please Select Gallery Images--}}
{{--                        </label>--}}
{{--                    </div>--}}

{{--                    @error('gallery')--}}
{{--                        <span class="text-danger" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                    @enderror--}}

{{--                    <div id="gallery--photos__upload"></div>--}}
{{--                </div>--}}


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
        //needs to delete

        // $("#gallery").change(function() {
        //     let gallerySection = $('#gallery--photos__upload');
        //     gallerySection.html('');
        //     let files = this.files;
        //     filesSize = files.length;
        //     for(let i = 0; i < filesSize; i++) {
        //         readURL(files[i]).then((urlImage) => {
        //             gallerySection.append(`<img src="${urlImage}"  alt=""/>`);
        //         });
        //     }
        // });


        $('#mainImage').change(function () {
            $('#mainImageAvatar').html('');
            readURL(this.files[0]).then(url => {
                $('#mainImageAvatar').append(`<img src="${url}"  alt=""/>`);
            })
        })

        CKEDITOR.replace( 'long_description' , {
            toolbarGroups: [
                {name: 'document', groups: ['mode', 'document', 'doctools']},
                {name: 'clipboard', groups: ['clipboard', 'undo']},
                {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
                {name: 'forms', groups: ['forms']},
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
                {name: 'links', groups: ['links']},
                {name: 'insert', groups: ['insert']},
                {name: 'styles', groups: ['styles']},
                {name: 'colors', groups: ['colors']},
                {name: 'tools', groups: ['tools']},
                {name: 'others', groups: ['others']},
                {name: 'about', groups: ['about']}
            ],

            removeButtons : 'Source,Save,Templates,Cut,SelectAll,Form,NewPage,Print,Copy,Paste,PasteText,PasteFromWord,Replace,Checkbox,Radio,Textarea,TextField,Select,Button,ImageButton,HiddenField,Preview,Find,Scayt,CopyFormatting,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Image,Flash,Smiley,Maximize,About'
        });

    </script>
@endpush
