@extends('layouts.app')

@section('title','  ألبوم الفيديو ')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/   شكرا </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allvideos mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h2 class="text-center mt-5 mb-2  main-color"> لقد تم عملية الدفع بنجاح  </h2>
            <div class="text-center mt-3 mb-5"><img src="{{url('design/shape.png')}}"></div>

              <div class="row mb-5 center-phone">
                
              </div>
          </div>
      </div>
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
