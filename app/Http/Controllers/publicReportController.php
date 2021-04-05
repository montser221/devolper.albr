<?php
namespace App\Http\Controllers;
use App\Models\publicReport;
use Illuminate\Http\Request;
use Storage;
class publicReportController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $reports = publicReport::latest()->paginate(10);
      return view('dashboard.reports.index')->with(['reports'=>$reports]);
  }

 //all reports
    public function allreports ()
    {
      $reports = publicReport::latest()->where('reportStatus',1)->paginate(6);
      return view('pages.allreports')->with([
        'reports'=>$reports,
      ]);
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
        'reportTitle'     => 'required|unique:public_reports',
        'imageFile'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2028',
        'reportFile'       => 'required|mimes:pdf,ppt,pptx,xls,xlsx,doc,docx|max:20480',
    ]);
    // // create project instance
    $files = new publicReport;

    if ($request->has('reportStatus'))
    {
      $files->reportStatus = $request->input('reportStatus');
    }

     if($request->file('reportFile')){
            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('reportFile')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;
            // dd($image_full_name);
            $uploads_folder =  getcwd() .'/uploads/reports';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
    
          $request->file('reportFile')->move($uploads_folder,$image_full_name);
          $files->reportFile=$image_full_name;
    
      }
      
       if($request->file('imageFile')){
            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('imageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;
            // dd($image_full_name);
            $uploads_folder =  getcwd() .'/uploads/reports';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
    
          $request->file('imageFile')->move($uploads_folder,$image_full_name);
          $files->imageFile=$image_full_name;
    
      }


    $files->reportTitle   = $request->input('reportTitle');
    $files->save();
    return redirect()->route('reports.index')->with('success','تم أضافة  الملف بنجاح');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = publicReport::find($id);
    return view('dashboard.reports.edit')->with(['data'=>$data]);
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
    $request->validate([
        'imageFile'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2028',
        'reportFile'       => 'mimes:pdf,ppt,pptx,xls,xlsx,doc,docx|max:20480',
    ]);
      if($request->file('reportFile')){
            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('reportFile')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;
            // dd($image_full_name);
            $uploads_folder =  getcwd() .'/uploads/reports';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
    
          $request->file('reportFile')->move($uploads_folder,$image_full_name);
           \DB::table('public_reports')
        ->where('reportId',$id)
        ->update([
            'reportFile'=>$image_full_name,
            ]);
        }
    
      
    if($request->file('imageFile')){
            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('imageFile')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;
            // dd($image_full_name);
            $uploads_folder =  getcwd() .'/uploads/reports';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
    
          $request->file('imageFile')->move($uploads_folder,$image_full_name);
          \DB::table('public_reports')
                ->where('reportId',$id)
                ->update([
                  'imageFile'=>$image_full_name,
                ]);    
      }
      
    

    if ($request->has('reportStatus'))
    {
      \DB::table('public_reports')
      ->where('reportId',$id)
      ->update([
        'reportStatus'=>$request->input('reportStatus'),
      ]);
    }
    if($request->has('reportTitle'))
    {
        \DB::table('public_reports')
        ->where('reportId',$id)
        ->update([
            'reportTitle'=>$request->input('reportTitle'),
            ]);
    }

    return redirect()->route('reports.index')->with('success','تم تحديث  الملف بنجاح');
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
        \Storage::delete(publicReport::find($id)->reportFile);
        \Storage::delete(publicReport::find($id)->imageFile);
      \DB::table('public_reports')
      ->where('reportId',$id)
      ->delete();
    }
    return redirect()->route('reports.index')->with('success','تم حذف الملف بنجاح  ');
  }
}
