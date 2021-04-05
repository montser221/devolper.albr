@extends('dashboard.index')
@section('title','إدرة  التقاريرالعامة ')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active" aria-current="page"> <a href="{{route('reports.index')}}"> إدرة   التقاريرالعامة </a></li>
     </ol>
    </nav>
    <div class="users">

      <div class="row " style="margin-bottom:15px">
        <div class="col">
          {{-- <form class="" action="" method="post">
            <input type="text" class="form-control" name="" value="">
          </form> --}}
        </div>

        <div class="col offset-lg-8">
          {{-- <a type="button" class="btn border border-dark  " name="button">  <i class="fa fa-upload fa-lg"></i>  تصدير </a>
          <a type="button" class="btn border border-dark " name="button"> <i class="fa fa-download fa-lg"></i> استيراد </a> --}}
              <!-- Button trigger modal Create New files -->
          <button data-toggle="modal" data-target="#createfiles" type="button" class="btn text-orange text-white " name="button">  <i class="fa fa-plus "></i> &nbsp;&nbsp; أنشاء </a>
        </div>

      </div>

      <!-- Modal -->
      <div class="modal fade" id="createfiles" tabindex="-1" data-keyboard="false"  data-backdrop="static" aria-labelledby="createfilesLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="createfilesLabel">أضافة  ملف</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form  id="create-form" enctype="multipart/form-data" method="post" action="{{route('reports.store')}}">
                @csrf
                @method('POST')

                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="reportTitle">  عنوان الملف </label>
                    <input id="i" type="text" name="reportTitle" class="form-control w-40" placeholder="عنوان الملف " >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="reportFile">  الملف      </label>
                    <input style="margin-right: 10%;" id="reportFile" type="file" name="reportFile" class="form-control-file w-80" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <label class="label-control" for="imageFile">  صورة مصغرة    </label>
                    <input style="margin-right: 10%;" id="imageFile" type="file" name="imageFile" class="form-control-file w-80" >
                  </div>
                </div>
                <div class="form-row">
                  <div class="col" style="margin-top:8%">
                    <div class="form-check">
                      <label class="form-check-label" for="reportStatus">
                        <input class="form-check-input" type="radio" name="reportStatus" id="reportStatus" value="1"  >
                        تفعيل
                      </label>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label" for="reportStatus">
                        <input class="form-check-input" type="radio" name="reportStatus" id="reportStatus" value="0"  >
                     الغاء
                      </label>
                    </div>
                  </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn text-warning btn-main mr-5" data-dismiss="modal">الغاء</button>
              <button style="width: 12%;margin: 0 8%;" type="submit" class="btn text-orange text-white "> إضافة <i class="fa fa-plus"></i></button>
            </div>
          </form>
          </div>
        </div>
      </div
    </div>
  </div>
      {{-- End Modal Create --}}
       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th> عنوان الملف </th>
          <th> الملف  </th>
          <th> صورة مصغرة  </th>
          <th>  الحالة </th>
          <th> أحداث  </th>
        </thead>
        <tbody>
             <?php $i=0; ?>
          @foreach ($reports as $file)
           <?php $i++; ?>
            <tr>
              <td>  رقم  {{ $i  }} </td>
              <td>{{  $file->reportTitle }}</td>
              <td> <a href="{{ url("uploads/reports/".$file->reportFile ) }}" style="color:#555;"> رابط الملف </a> </td>
              <td><img class="img-responsive img-thambnail" style="max-width:40px" src="{{  url("uploads/reports/".$file->imageFile )}}" alt="" /></td>

              <td class="@if ($file->reportStatus ==1) text-success  @else text-danger   @endif">
                @if ($file->reportStatus ==1)
                  تم التفعيل
                @else
                  غير مفعل
                @endif
              </td>
              <td>
                <form class="form-inline" action="{{route('reports.destroy',$file->reportId ) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a class="btn  btn-sm ml-1" href="{{route('reports.edit',$file->reportId)}}" ><i class="fa fa-edit "></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="container">
    {{ $reports->links() }}
    </div>
@endsection
