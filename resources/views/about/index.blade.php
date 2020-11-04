@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">About</h1>
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
            <form action="{{ route('about.update', ['about' => $about->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $about->title ?? old('title') }}" name="title">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="5" class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $about->description ?? old('description') }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Main Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="mainImage" aria-describedby="inputGroupFileAddon01" name="image">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                    <div id="mainImageAvatar">
                        <img src="{{ $about->image_path }}" alt="">
                        @if($about->image_path)
                            <input type="hidden" name="mainImageUploaded" value="{{ $about->image_path }}">
                        @endif
                    </div>

                    @error('image')
                    <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alt">Alt</label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" value="{{ $about->alt ?? old('alt') }}" name="alt">
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
            readURL(this.files[0]).then(url => {
                $('#mainImageAvatar').append(`<img src="${url}"  alt=""/>`);
            })
        })

        CKEDITOR.replace('description' , {
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

