<?php

namespace App\Http\Controllers;
use App\Models\OtherMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class OtherMemberController extends Controller
{

    public function index()
    {
      $allfiles = OtherMember::latest()->paginate(10);
        return view('dashboard.otherfiles.index')->with(['allfiles'=>$allfiles]);
    }
  
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
      $request->validate([
          'memName'        => 'required|unique:other_members',
          'memFile'        => 'required|mimes:pdf|max:14946',
          'memEmail'       => 'required',
          'memPhone'       => 'required',
      ]);
      // // create project instance
      $otherfiles = new OtherMember;
  
      if ($request->has('memStatus'))
      {
        $otherfiles->memStatus = $request->input('memStatus');
      }
  
      //pdf file
      if($request->file('memFile')){
         $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('memFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/otherfile/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('memFile')->move($uploads_folder,    $image_full_name);
        // $reportFiles->reportPdfFile=$image_full_name;
        // $path = Storage::putFile(getcwd().'/otherfile', $request->file('memFile'));
          $otherfiles->memFile=$image_full_name;
      }

  
      $otherfiles->memName   = $request->input('memName');
      $otherfiles->memEmail   = $request->input('memEmail');
      $otherfiles->memPhone   = $request->input('memPhone');
      $otherfiles->save();
      return redirect()->route('otherfiles.index')->with('success','تم أضافة  الملف بنجاح');
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = OtherMember::find($id);
      return view('dashboard.otherfiles.edit')->with(['data'=>$data]);
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
      if($request->file('memFile')){
             $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('memFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/otherfile/';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('memFile')->move($uploads_folder,    $image_full_name);
        // $reportFiles->reportPdfFile=$image_full_name;
        // $path = Storage::putFile(getcwd().'/otherfile', $request->file('memFile'));
        //   $otherfiles->memFile=$image_full_name;
        // Storage::delete(OtherMember::find($id)->memFile);
        // $path = Storage::putFile('otherfile', $request->file('memFile'));
          \DB::table('other_members')
          ->where('memId',$id)
          ->update([
            'memFile'=> $image_full_name ,
            ]);
      }
  
       
      if ($request->has('memStatus'))
      {
        \DB::table('other_members')
        ->where('memId',$id)
        ->update([
          'memStatus'=>$request->input('memStatus'),
        ]);
      }
      \DB::table('other_members')
      ->where('memId',$id)
      ->update([
        'memName'=>$request->input('memName'),
        'memEmail'=>$request->input('memEmail'),
        'memPhone'=>$request->input('memPhone'),
      ]);
  
      return redirect()->route('otherfiles.index')->with('success','تم تحديث  الملف بنجاح');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete project by id
      if(intval($id)){
    //   $tt= Storage::delete(OtherMember::find($id)->memFile);
        \DB::table('other_members')
        ->where('memId',$id)
        ->delete();
      }
      return redirect()->route('otherfiles.index')->with('success','تم حذف الملف بنجاح  ');
    }
}
