@extends('layouts.app')

@section('title',' محاضر الجمعية العمومية')

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/محاضر الجمعية العمومية      </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allfiles mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2 main-color">   محاضر الجمعية العمومية   </h3>
            <div class="text-center mt-3 mb-5"><img src="{{url('design/shape.png')}}"></div>

              <div class="row mb-5">
                
                @foreach ($associcFiles as $file)
                  <div class="col-sm-12 col-md-4 4 mt-5 center-phone">
                    <a target="_blank" class="d-block main-color" href="{{url($file->policyFile)}}">
                    <img src="{{url( $file->policyImage)}}" alt="" style="width: 100px;">
                  
                    <span class="video-title" style=" display: block; margin-right: 15px; margin-top: 14px; margin-bottom: 15px;">{{$file->policyTitle}} </span>
                      </a>
                    <!--<span class="video-shows-count"> <i class="fa fa-eye"></i>-->
                    <!--<span>0</span>-->
                    <span class="video-date" style="color:#2fa89c">{{ $file->created_at->format('Y-m-d')}}</span>
                    </span>
                    <br>  
                  </div>     
                @endforeach
              </div>
         
          <div class="container">
              {{$associcFiles->links() }}
          </div>
          </div>
      </div>
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
