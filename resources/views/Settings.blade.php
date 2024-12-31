@extends('dash::app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-dark text-capitalize">{{ $title }} </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-3 pb-2">
                        <div class="row">
                            @if (!empty($settings))
                                <form action="{{dash('page/Settings')}}/{{ $settings->id }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="site_name" class="form-label">{{ __('settings.site_name') }}</label>
                                            <input type="text" value="{{ $settings->site_name }}"
                                                class="form-control {{ $errors->has('site_name') ? 'is-invalid' : '' }} border"
                                                id="site_name" value="" name="site_name">
                                            @error('site_name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="maintenance_mode"
                                                class="form-label">{{ __('settings.maintenance_mode') }}</label>
                                            <select
                                                class="form-control {{ $errors->has('maintenance_mode') ? 'is-invalid' : '' }} border"
                                                name="maintenance_mode" id="maintenance_mode">
                                                <option value="on" @selected($settings->maintenance_mode == 'on')>On</option>
                                                <option value="off" @selected($settings->maintenance_mode == 'off')>Off</option>
                                            </select>
                                            @error('maintenance_mode')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="description"
                                                class="form-label">{{ __('settings.descriptions') }}</label>
                                            <textarea class="form-control {{ $errors->has('descriptions') ? 'is-invalid' : '' }} border" name="descriptions"
                                                id="description" cols="30" rows="5">{{ $settings->description }}</textarea>
                                            @error('descriptions')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-6">
                                            <label for="keywords" class="form-label">{{ __('settings.keywords') }}</label>
                                            <textarea class="form-control {{ $errors->has('keywords') ? 'is-invalid' : '' }} border" name="keywords" id="keywords"
                                                cols="30" rows="5">{{ $settings->keywords }}</textarea>
                                            @error('keywords')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label for="logo" class="form-label">{{ __('settings.logo') }}</label>
                                        <div class="text-center mb-2">
                                            <img src="{{ $settings->logo }}" alt="{{ __('settings.logo') }}"
                                                class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                        <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }} border"
                                            type="file" name="logo" id="logo">
                                        @error('logo')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-3">
                                        <label for="icon" class="form-label">{{ __('settings.icon') }}</label>
                                        <div class="text-center mb-2">
                                            <img src="{{ asset($settings->icon) }}" alt="{{ __('settings.icon') }}"
                                                class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                        <input class="form-control {{ $errors->has('icon') ? 'is-invalid' : '' }} border"
                                            type="file" name="icon" id="icon">
                                        @error('icon')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-success">{{ __('settings.button') }}</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
