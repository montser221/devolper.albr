@extends('layouts.app')

@section('title','    البوم الصور ')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/     البوم الصور       </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allfiles mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2 main-color">       البوم الصور    </h3>
            <div class="text-center mt-3 mb-5"><img src="{{url('design/shape.png')}}"></div>

              <div class="row mb-5">
               {{ dd($allImages) }}
              </div>
         
          
          </div>
      </div>
    {{ $allImages->links() }}
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
<
@include('includes.footer')
