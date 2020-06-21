@extends('layouts.app')

@section('headline')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings</h1>
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
            <form action="{{ route('settings.update', ['setting' => $settings->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ $settings->phone ?? old('phone') }}" name="phone">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone_footer">Phone Footer</label>
                    <input type="text" class="form-control @error('phone_footer') is-invalid @enderror" id="phone_footer" value="{{ $settings->phone_footer ?? old('phone_footer') }}" name="phone_footer">
                    @error('phone_footer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="office_hours">Office Hours</label>
                    <input type="text" class="form-control @error('office_hours') is-invalid @enderror" id="office_hours" value="{{ $settings->office_hours ?? old('office_hours') }}" name="office_hours">
                    @error('office_hours')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="office_hours_footer">Footer Office Hours</label>
                    <input type="text" class="form-control @error('office_hours_footer') is-invalid @enderror" id="office_hours_footer" value="{{ $settings->office_hours_footer ?? old('office_hours_footer') }}" name="office_hours_footer">
                    @error('office_hours_footer')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $settings->email ?? old('email') }}" name="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" value="{{ $settings->location ?? old('location') }}" name="location">
                    @error('location')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="map_address">Map address</label>
                    <input type="text" class="form-control @error('map_address') is-invalid @enderror" id="map_address" value="{{ $settings->map_address ?? old('map_address') }}" name="map_address">
                    @error('map_address')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="about_footer">About Us Footer</label>
                    <textarea class="form-control @error('about_footer') is-invalid @enderror" id="about_footer" name="about_footer">{{ $settings->about_footer ?? old('about_footer') }}</textarea>
                    @error('about_footer')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="facebook">Facebook</label>
                    <textarea class="form-control @error('facebook') is-invalid @enderror" id="facebook" name="facebook">{{ $settings->facebook ?? old('facebook') }}</textarea>
                    @error('facebook')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <textarea class="form-control @error('youtube') is-invalid @enderror" id="youtube" name="youtube">{{ $settings->youtube ?? old('youtube') }}</textarea>
                    @error('youtube')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="yelp">Yelp</label>
                    <textarea class="form-control @error('yelp') is-invalid @enderror" id="yelp" name="yelp">{{ $settings->yelp ?? old('yelp') }}</textarea>
                    @error('yelp')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="bbb">BBB</label>
                    <textarea class="form-control @error('bbb') is-invalid @enderror" id="bbb" name="bbb">{{ $settings->bbb ?? old('bbb') }}</textarea>
                    @error('bbb')
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
