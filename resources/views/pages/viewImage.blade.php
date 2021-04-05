@extends('layouts.app')
@section('title','تفاصيل الصورة')

@section('header')
    @include('includes.header')
@endsection

@section('content')
    <div class="container">
        <div class="imageView">
            <img src="{{ url('storage/'.$img->imageFile) }}" alt="{{ $img->imageTitle }}" />
        </div>
        <a class="btn mb-4 mt-4" href="{{ route('gallery') }}">عودة الى البوم الصور</a>
    </div>
@endsection