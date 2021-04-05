@extends('dashboard.index')
@section('title','رسائل التواصل')
@section('dashboard-content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">لوحة التحكم</a></li>
      <li class="breadcrumb-item active "  > <a>  رسائل التواصل  </a></li>
     </ol>
    </nav>
    <div class="users">
         <form  action="{{route('exportcontact')}}" method="get">
          <div class="form-row">
            <div class="col">
              <label for="endDate" class="label-control ">
                  تاريخ النهاية
              </label>
              <input class="form-control" type="date" name="endDate" id="enddate"  value="{{old('endDate')}}" >
            </div>
            <div class="col">
              <label for="startdate" class="label-control">
                 تاريخ البداية
              </label>
              <input class="form-control" type="date" name="startDate"  id="startdate" value="{{old('startdate')}}">
            </div>
            <div class="col">
                <button type="submit"  class="btn  border border-dark ml-2 "  style="margin-top:2rem" ><i class="fa fa-upload fa-lg"></i> تصدير </button>
            </div>
          </div>

        </form>
        <!--<div class="col offset-md-10">-->
        <!-- <?php $_count =0 ?>-->
        <!--    @foreach ($allContact as $contact)-->
            
        <!--<?php $_count =$contact->count() ?>-->
        <!--    @endforeach-->
        <!--    @if ($_count > 0)-->
        <!--     <a class="btn  border border-dark ml-2 mt-2" href="{{ url("exportcontact") }}">-->
        <!--     <i class="fa fa-download" aria-hidden="true"></i>-->
        <!--     تصدير</a>-->

        <!--    @endif -->
        </div>
       <!---->

       {{-- Errors message --}}
      @include('includes.errors')
      {{-- success message --}}
      @include('includes.success')

      <table class="table table-hover table-bordered">
        <thead>
          <th>#</th>
          <th>   الاسم </th>
          <th> البريد الالكتروني </th>
          <th>  الهاتف   </th>
          <th> الموضوع</th>
          <th> الرسالة</th>
          <th> نوع الرسالة</th>
          <th> أحداث  </th>
        </thead>
        <tbody>
            <?php
             $i =10;
             $id =0;
             $countofitems = $allContact->count();
            $pageId = request()->query('page');
            
            // echo " pageId ".$pageId . '  countofitems' . $countofitems;
            if($pageId == 1)
            {
              $id =0;
            }
            else if($pageId ==2)
            {
                $id =11;
            }
            else if($pageId ==3)
            {
                $id =21;
            }
            else if($pageId ==4)
            {
                $id =31;
            }
             else if($pageId ==5)
            {
                $id =41;
            }
             else if($pageId ==6)
            {
                $id =51;
            }
              else if($pageId ==7)
            {
                $id =61;
            }
            // function reslove()
            // {
            //     $pageId++;
                
            // }
            
            ?>
          @foreach ($allContact as $contact)
            <?php
            $id++;
            ?>
            <tr>
              <td>  {{ $id }}</td>
              <td>{{  $contact->fullname }}</td>
              <td>{{  $contact->email }}</td>
              <td>{{  $contact->phone ?? "" }}</td>
              <td>{{  $contact->topic }}</td>
              <td>{{ substr( $contact->message,0,50) }}</td>
              <td>
               @if($contact->msgType=="complaint")
               شكوى
              @elseif($contact->msgType == "suggist")
              إقتراح
              @elseif($contact->msgType == "inquire")
              أستفسار
               @endif
               </td>
              <td>
                <form class="form-inline" action="{{route('contact.destroy',$contact->contactId) }}" method="post">
                  @csrf
                  @method("DELETE")
                  <a style="color: #333" href="{{route('contact.msgDetail',$contact->contactId)}}"><i class="fa fa-eye fa-lg"></i></a>
                  <button   type="submit" class="btn  btn-sm  btn-project"><i class="fa fa-bank "></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $allContact->links() }}
    </div>
@endsection
