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
            <form action="{{ route('services.update', ['service' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $service->title ?? old('title') }}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_title">Sub Title</label>
                    <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" value="{{ $service->sub_title ?? old('sub_title') }}" name="sub_title">
                    @error('sub_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description">{{ $service->short_description ?? old('short_description') }}</textarea>
                    @error('short_description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="long_description">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description">{{ $service->long_description ?? old('long_description') }}</textarea>
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
                    <div id="mainImageAvatar">
                        <img src="{{ $service->main_image_path }}" alt="">
                        @if($service->main_image_path)
                            <input type="hidden" name="mainImageUploaded" value="{{ $service->main_image_path }}">
                        @endif
                    </div>

                    @error('mainImage')
                        <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                    <p class="my-4">Gallery Images</p>
                    <div id="gallery--photos__show">
                        @foreach($service->gallery as $image)
                            <div data-id="{{ $image->id }}">
                                <img src="{{ $image->path }}" alt="">
                                <a class="delete-image d-block" data-id="{{ $image->id }}">
                                    <i class="fa fa-trash text-danger"></i>
                                    Remove Image
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
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
                    url: "/services/order/change/gallery",
                    type: "POST",
                    data: {
                        _token: $("meta[name='csrf-token']").attr("content"),
                        orders: orders
                    }
                })
            }
        });

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
                    gallerySection.append(`<img src="${urlImage}"  alt=""/>`)
                });
            }
        });

        $('.delete-image').click(function () {
            let id = $(this).attr('data-id');
            let self = $(this);

            if(confirm('Are you sure want to delete this item?')) {
                $.ajax({
                    url: "/services/images/" + id,
                    type: "DELETE",
                    success: function () {
                        self.closest('div').remove();
                    }
                })
            }
        })

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
