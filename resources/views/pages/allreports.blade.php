@extends('layouts.app')

@section('title', __('reports.reportTitle') )

@include('includes.header')
<div class="dulni">
  <!--Start Banner-->
  <div class="  px-0 banner" id="dulani-banner">
    <div class="dulni-inner">
      <div class="container">
        <div class="page-path">
          <p><a href="{{url("/")}}"> الرئيسية </a>/ {{__('reports.reportTitle')}} </p>
        </div>
      </div>
    </div>

  </div>
        <!-- End Banner-->

      <!-- Start Dullani Form-->
        <div class="allfiles mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2"> التقارير العامة </h3>
            <div class="text-center mt-3 mb-5"><img src="{{url('design/shape.png')}}"></div>

              <div class="row mb-5">
{{-- //  `ReportId`, `reportTitle`, `reportImageFile`, `reportPdfFile`, `reportStatus`, `created_at`, `updated_at` --}}
                
                @forelse ($reports as $file)
                  <div class="col-sm-12 col-md-4 4 mt-5 center-phone">
                    <a target="_blank" class="d-block" href="{{url("uploads/reports/".$file->reportFile)}}">
                    <img style="width:100px" src="{{url("uploads/reports/".$file->imageFile)}}" alt="{{ $file->reportTitle }}">
                  
                    <span class="video-title" style=" display: block; margin-right: 15px; margin-top: 14px; margin-bottom: 15px;color:#2fa89c">{{$file->reportTitle}} </span>
                      </a>
                    <!--<span class="video-shows-count"> <i class="fa fa-eye"></i>-->
                    <!--<span>0</span>-->
                    <span class="video-date" style="color:#2fa89c">{{ $file->created_at->format('Y-m-d')}}</span>
                    </span>
                    <br>  
                  </div>    
                @empty
                <div class="lead text-center">
                  {{-- @lang('emptyReport') --}}
                {{ __('reports.emptyReport') }}
                </div> 
                @endforelse
              </div>
         
          
          </div>
          {{ $reports->links() }}
      </div>
    </div>
</div>
{{-- @include('includes.ourlocation') --}}
@include('includes.footer')
