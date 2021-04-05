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
        <div class="gallery mx-auto">
          <div class="container" id="dulani-form-container">
            
            <h3 class="text-center mt-5 mb-2 main-color">       البوم الصور    </h3>
            <div class="text-center mt-3 mb-5"><img src="{{url('design/shape.png')}}"></div>

              <div class="row">
               @foreach ($allimages->chunk(3) as $imgCollection)
                  @forelse ($imgCollection as $img)
                  <div class=" col-sm-12 col-md-4  img">
                  <a href="{{ route('viewImage',$img->imageId) }}">
                    <img src="{{ url('storage/'.$img->imageFile) }}" alt="{{ $img->imageTitle }}" /> 
                  </a>
                  </div>
                  @empty
                    <div class="lead text-center">
                      البوم الصور خالي 
                  </div>
                  @endforelse
               @endforeach
              </div>

          </div>
      </div>
    {{ $allimages->links() }}
    </div>
</div>
@include('includes.footer')
