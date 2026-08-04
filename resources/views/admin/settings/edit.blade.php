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
                <label class="fw-bold"for="hero_title_en">Hero Title English</label><br>
                <input type="text" name="hero_title_en" id="hero_title" class="form-control" value="{{ $setting->hero_title_en }}">
                @error('hero_title_en') <small class="text-danger">{{ $message }}</small> @enderror
            
                <!-- Hero Title pashto -->
                <label class="fw-bold"for="hero_title">Hero Title Pashto</label><br>
                <input type="text" name="hero_title_ps" id="hero_title" class="form-control" value="{{ $setting->hero_title_ps }}">
                @error('hero_title_ps') <small class="text-danger">{{ $message }}</small> @enderror
            
                <!-- Hero Description --><br>
                <label class="fw-bold" for="hero_dec">Hero Description English</label>
                <textarea name="hero_description_en" id="hero_dec" class="form-control">{{ $setting->hero_description_ps }}</textarea><br><br>
                @error('hero_description_en') <small class="text-danger">{{ $message }}</small>@enderror
               
                <!-- Hero Description --><br>
                <label class="fw-bold" for="hero_dec">Hero Description Pashto</label>
                <textarea name="hero_description_ps" id="hero_dec" class="form-control">{{ $setting->hero_description_ps }}</textarea><br><br>
                @error('hero_description_ps') <small class="text-danger">{{ $message }}</small>@enderror
               
                <!-- about digital libary -->
                <label class="fw-bold" for="hero_dec">About digital library English</label>
                <textarea name="about_digital_library_en"  class="form-control">{{ $setting->about_digital_library_en }}</textarea><br><br>
                @error('about_digital_library_en') <small class="text-danger">{{ $message }}</small>@enderror
                
                <label class="fw-bold" for="hero_dec">About digital library Pashto</label>
                <textarea name="about_digital_library_ps"  class="form-control">{{ $setting->about_digital_library_ps }}</textarea><br><br>
                @error('about_digital_library_ps') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- about digital libary mission and vision -->
                <label class="fw-bold" for="hero_dec">Our mission and vision  english</label>
                <textarea name="mission_vision_en" id="hero_dec" class="form-control">{{ $setting->mission_vision_en }}</textarea><br><br>
                @error('mission_vision_en') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- about digital libary mission and vision -->
                <label class="fw-bold" for="hero_dec">Our mission and vision English</label>
                <textarea name="mission_vision_ps" id="hero_dec" class="form-control">{{ $setting->mission_vision_ps }}</textarea><br><br>
                @error('mission_vision_ps') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- about digital libary purposes -->
                <label class="fw-bold" for="hero_dec">Our purposes English</label>
                <textarea name="purpose_en" id="hero_dec" class="form-control">{{ $setting->purpose_en }}</textarea><br><br>
                @error('purpose_en') <small class="text-danger">{{ $message }}</small>@enderror
                
                <label class="fw-bold" for="hero_dec">Our purposes Pashto </label>
                <textarea name="purpose_ps" id="hero_dec" class="form-control">{{ $setting->purpose_ps }}</textarea><br><br>
                @error('purpose_ps') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- Footer -->
                <label class="fw-bold" for="footer_dec">Footer Text English</label><br>
                <textarea name="footer_text_en" class="form-control" id="footer_dec">{{ $setting->footer_text_en }}</textarea><br><br>   
                @error('footer_text_en') <small class="text-danger">{{ $message }}</small>@enderror
                
                <!-- Footer -->
                <label class="fw-bold" for="footer_dec">Footer Text Pashto</label><br>
                <textarea name="footer_text_ps" class="form-control" id="footer_dec">{{ $setting->footer_text_ps }}</textarea><br><br>   
                @error('footer_text_ps') <small class="text-danger">{{ $message }}</small>@enderror
                
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