@extends('dashboard.index')
@section('title',' تعديل  محاضر الجمعية العمومية ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item " aria-current="page"> <a href="{{route("policies.index")}}">  إدارة   السياسات العامة </a></li>
      <li class="breadcrumb-item active"> تعديل  محاضر الجمعية العمومية </li>
    </ol>
    </nav>

    <div class="policies-edit" style="background-color:#FFF;padding:15px">
        {{-- Errors message --}}
        @include('includes.errors')
        @include('includes.success')
        <h5>تعديل  محاضر الجمعية العمومية </h5>

        <form  id="edit-form" enctype="multipart/form-data" method="post" action="{{route('policies.update',$data->policyId)}}">
          @csrf
          @method('PATCH')
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="policyTitle">العنوان</label>
              <input id="inputpolicyTitle" type="text" name="policyTitle" class="form-control"  value="{{$data->policyTitle}}" >
            </div>

          </div>
          <div class="form-row">
            <div class="col">
              <label class="label-control" for="policyImage">  الصورة المميزة  </label>
              <input type="file" class="form-control-file" name="policyImage" >
            </div>
            <div class="col">
              <label class="label-control" for="policyFile">    ملف PDF  </label>
              <input type="file" class="form-control-file" name="policyFile" >
            </div>
          </div>
        
        <div class="form-row">
            <div class="col" style="margin-top:8%">
              <div class="form-check">
                <label class="form-check-label" for="policyStatus">
                  <input class="form-check-input" type="radio" name="policyStatus" id="policyStatus" value="1"  >
                  تفعيل
                </label>
              </div>
              <div class="form-check">
                <label class="form-check-label" for="policyStatus">
                  <input class="form-check-input" type="radio" name="policyStatus" id="policyStatus" value="0"  >
                  إلغاء تفعيل
                </label>
              </div>
          </div>
          </div>

       
          </div>

        <button type="submit" class="btn text-orange text-white mt-3"> حفظ التعديلات <i class="fa fa-plus"></i></button>
      </form>
    </div>

@endsection
