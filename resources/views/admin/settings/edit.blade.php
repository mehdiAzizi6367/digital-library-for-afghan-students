@extends('layouts.admin')

@section('title','edit')

@section('content')

<h2 class="text-center h3">Admin Settings</h2>

<div class="container bg-light w-75">
    <div class="row">
        <div class="col-md-12 m-auto">
              @if(session('success'))
                <p style="color:green">{{ session('success') }}</p>
              @endif
            <form action="/admin/settings" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Hero Title -->
                <label class="fw-bold"for="hero_title">Hero Title</label><br>
                <input type="text" name="hero_title" id="hero_title" class="form-control" value="{{ $setting->hero_title }}">
                @error('hero_title') <small class="text-danger">{{ $message }}</small> @enderror
            
                <!-- Hero Description --><br>
                <label class="fw-bold" for="hero_dec">Hero Description</label>
                <textarea name="hero_description" id="hero_dec" class="form-control">{{ $setting->hero_description }}</textarea><br><br>
                @error('hero_description') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- Footer -->
                <label class="fw-bold" for="footer_dec">Footer Text</label><br>
                <textarea name="footer_text" class="form-control" id="footer_dec">{{ $setting->footer_text }}</textarea><br><br>   
                @error('footer_text') <small class="text-danger">{{ $message }}</small>@enderror
                
                    <!-- Logo -->
                    <label class="fw-bold" for="logo">Logo</label><br>
                    <input type="file" name="logo" id="logo" class="form-control"><br>
                
                    @if($setting->logo)
                        <img src="{{ asset('uploads/'.$setting->logo) }}" width="100">
                    @endif
                    @error('logo')
                     <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <br><br>
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection