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
                    <label for="city">City &#40;Displayed on the Thumbnail 1st and Page 2nd&#41;</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" value="{{ old('city', $location->city) }}" name="city">
                    @error('city')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lat">latitude</label>
                    <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat" value="{{ old('lat', $location->lat) }}" name="lat">
                    @error('lat')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lon">longitude</label>
                    <input type="text" class="form-control @error('lon') is-invalid @enderror" id="lon" value="{{ old('lon', $location->lon) }}" name="lon">
                    @error('lon')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" value="{{ old('url', $location->url) }}" name="url">
                    @error('url')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title &#40;Displayed on the Page 1st</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title', $location->title) }}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_title">Sub Title &#40;Displayed on the Thumbnail 2nd and Page 3rd&#41;</label>
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
                    <label for="what_to_eat">What to eat</label>
                    <textarea class="form-control @error('what_to_eat') is-invalid @enderror" id="what_to_eat" name="what_to_eat">{{ old('what_to_eat', $location->what_to_eat) }}</textarea>
                    @error('what_to_eat')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="where_to_go">Where to go</label>
                    <textarea class="form-control @error('where_to_go') is-invalid @enderror" id="where_to_go" name="where_to_go">{{ old('where_to_go', $location->where_to_go) }}</textarea>
                    @error('where_to_go')
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
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address', $location->address) }}" name="address">
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="population">Population</label>
                    <input type="text" class="form-control @error('population') is-invalid @enderror" id="population" value="{{ old('population', $location->population) }}" name="population">
                    @error('population')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="average_age">Average age</label>
                    <input type="text" class="form-control @error('average_age') is-invalid @enderror" id="average_age" value="{{ old('average_age', $location->average_age) }}" name="average_age">
                    @error('average_age')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="median_income">Median income</label>
                    <input type="text" class="form-control @error('median_income') is-invalid @enderror" id="median_income" value="{{ old('median_income', $location->median_income) }}" name="median_income">
                    @error('median_income')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="median_home_value">Median home value</label>
                    <input type="text" class="form-control @error('median_home_value') is-invalid @enderror" id="median_home_value" value="{{ old('median_home_value', $location->median_home_value) }}" name="median_home_value">
                    @error('median_home_value')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="wiki_link">Wiki link</label>
                    <input type="text" class="form-control @error('wiki_link') is-invalid @enderror" id="wiki_link" value="{{ old('wiki_link', $location->wiki_link) }}" name="wiki_link">
                    @error('wiki_link')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>City Emblem</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="cityEmblem" name="city_emblem" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div id="cityEmblemImage">
                        <img src="{{ $location->city_emblem_path }}" alt="">
                        @if($location->city_emblem_path)
                            <input type="hidden" name="cityEmblemUploaded" value="{{ $location->city_emblem_path }}">
                        @endif
                    </div>

                    @error('city_emblem')
                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="meta_description">Meta Description </label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description">{{ old('meta_description', $location->meta_description) }}</textarea>
                    @error('meta_description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" value="{{ old('meta_title', $location->meta_title) }}" name="meta_title">
                    @error('meta_title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alt_city_emblem">Alt</label>
                    <input type="text" class="form-control @error('alt_city_emblem') is-invalid @enderror" id="alt_city_emblem" value="{{ $location->alt_city_emblem ?? old('alt_city_emblem') }}" name="alt_city_emblem">
                    @error('alt_city_emblem')
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
                    <label for="alt_main">Alt (main image)</label>
                    <input type="text" class="form-control @error('alt_main') is-invalid @enderror" id="alt_main" value="{{ $location->alt_main ?? old('alt_main') }}" name="alt_main">
                    @error('alt_main')
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
                    <label for="alt_banner_first">Alt (first banner)</label>
                    <input type="text" class="form-control @error('alt_banner_first') is-invalid @enderror" id="alt_banner_first" value="{{ $location->alt_banner_first ?? old('alt_banner_first') }}" name="alt_banner_first">
                    @error('alt_banner_first')
                    <span class="invalid-feedback" role="alert">
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
                <div class="form-group">
                    <label for="alt_banner_second">Alt (second banner)</label>
                    <input type="text" class="form-control @error('alt_banner_second') is-invalid @enderror" id="alt_banner_second" value="{{ $location->alt_banner_second ?? old('alt_banner_second') }}" name="alt_banner_second">
                    @error('alt_banner_second')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="places_around">Places Around</label>
                    <input type="text" class="form-control @error('places_around') is-invalid @enderror" id="places_around" value="{{ old('places_around', $location->places_around) }}" name="places_around">
                    @error('places_around')
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

        $('#cityEmblem').change(function () {
            $('#cityEmblemImage').html('');
            readURL(this.files[0]).then(url => {
                $('#cityEmblemImage').append(`<img src="${url}"  alt=""/>`);
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
        CKEDITOR.replace( 'what_to_eat', ckEditorConfig);
        CKEDITOR.replace( 'where_to_go', ckEditorConfig);
    </script>
@endpush
