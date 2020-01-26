@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Locations</h1>

        <a class="btn btn-success" href="{{ route('locations.index') }}">Locations</a>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 col-12">
        <div class="card-body">
            <form action="{{ route('locations.update', ['location' => $location->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{ old('city', $location->city) }}" name="city">
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lat">Lat</label>
                    <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat" value="{{ old('lat', $location->lat) }}" name="lat">
                    @error('lat')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lon">Lon</label>
                    <input type="text" class="form-control @error('lon') is-invalid @enderror" id="lon" value="{{ old('lon', $location->lon) }}" name="lon">
                    @error('lon')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $location->title) }}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_title">Sub Title</label>
                    <input type="text" class="form-control @error('sub_title') is-invalid @enderror" id="sub_title" value="{{ old('sub_title', $location->sub_title) }}" name="sub_title">
                    @error('sub_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $location->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="facts_left">Facts Left</label>
                    <textarea class="form-control @error('facts_left') is-invalid @enderror" id="facts_left" name="facts_left">{{ old('facts_left', $location->facts_left) }}</textarea>
                    @error('facts_left')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="facts_right">Facts Right</label>
                    <textarea class="form-control @error('facts_right') is-invalid @enderror" id="facts_right" name="facts_right">{{ old('facts_right', $location->facts_right) }}</textarea>
                    @error('facts_right')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" value="{{ old('website', $location->website) }}" name="website">
                    @error('website')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="city_phone">City phone</label>
                    <input type="text" class="form-control @error('city_phone') is-invalid @enderror" id="city_phone" value="{{ old('city_phone', $location->city_phone) }}" name="city_phone">
                    @error('city_phone')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="police_address">Police address</label>
                    <input type="text" class="form-control @error('police_address') is-invalid @enderror" id="police_address" value="{{ old('police_address', $location->police_address) }}" name="police_address">
                    @error('police_address')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="police_phone">Police phone</label>
                    <input type="text" class="form-control @error('police_phone') is-invalid @enderror" id="police_phone" value="{{ old('police_phone', $location->police_phone) }}" name="police_phone">
                    @error('police_phone')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="police_email">Police email</label>
                    <input type="text" class="form-control @error('police_email') is-invalid @enderror" id="police_email" value="{{ old('police_email', $location->police_email) }}" name="police_email">
                    @error('police_email')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="donate_address">Donate address</label>
                    <input type="text" class="form-control @error('donate_address') is-invalid @enderror" id="donate_address" value="{{ old('donate_address', $location->donate_address) }}" name="donate_address">
                    @error('donate_address')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="donate_phone">Donate phone</label>
                    <input type="text" class="form-control @error('donate_phone') is-invalid @enderror" id="donate_phone" value="{{ old('donate_phone', $location->donate_phone) }}" name="donate_phone">
                    @error('donate_phone')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Main Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mainImage" aria-describedby="inputGroupFileAddon01" name="main_image" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div id="mainImageAvatar">
                        <img src="{{ $location->main_image_path }}" alt="">
                        @if($location->main_image_path)
                            <input type="hidden" name="mainImageUploaded" value="{{ $location->main_image_path }}">
                        @endif
                    </div>

                    @error('main_image')
                    <span class="text-danger" role="alert">
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
                        <img src="{{ $location->banner_first_path }}" alt="">
                        @if($location->banner_first_path)
                            <input type="hidden" name="bannerFirstUploaded" value="{{ $location->banner_first_path }}">
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
                        <img src="{{ $location->banner_second_path }}" alt="">
                        @if($location->banner_second_path)
                            <input type="hidden" name="bannerSecondUploaded" value="{{ $location->banner_second_path }}">
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

        $('#mainImage').change(function () {
            $('#mainImageAvatar').html('');
            readURL(this.files[0]).then(url => {
                $('#mainImageAvatar').append(`<img src="${url}"  alt=""/>`);
            })
        })


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


        let ckEditorConfig = {
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
        };

        CKEDITOR.replace( 'description', ckEditorConfig);
        CKEDITOR.replace( 'facts_left', ckEditorConfig);
        CKEDITOR.replace( 'facts_right', ckEditorConfig);
    </script>
@endpush
