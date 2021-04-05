<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\ProjectsCategories;
use App\Models\DenoatePayDetail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DenoateExample;
use Intervention\Image\Facades\Image;

class UrgentProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allprojects = Projects::with(['arrow','denoate'])->latest()->whereNotIn('projectCategoryId',[1])->paginate(10);
        return view('dashboard.urgentprojects.index')->with(['allprojects'=>$allprojects]);
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
       
          'projectName'        => 'required|unique:projects|max:255',
        //   'projectCategoryId'  => 'required|numeric',
          'projectDesc'        => 'required',
          'projectIcon'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
          'projectImage'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:14096',
        //   'projectWrapper'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
          'projectText'        => 'required',
          'projectLocation'    => 'required',
          'projectCost'        => 'required|numeric',
      ]);
      // create project instance
      $project = new Projects;

      // check if project status checked or not
      if($request->has('projectStatus')){
          $project->projectStatus=1;
      }
      if($request->has('whatsapp')){
          $project->whatsapp=$request->input('whatsapp');
      }

      if($request->file('projectIcon')){
        // upload project icon and store it in database
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('projectIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
        
          $request->file('projectIcon')->move($uploads_folder,$image_full_name);
          $image = Image::make( $uploads_folder . $image_full_name )->fit(1200,1200);
          $image->save();
          $project->projectIcon=$image_full_name;
      }
      // upload project image and store it in database
      if($request->file('projectImage')){
            $image_name = time() . rand(1,1000000000000);
            $image_ext = $request->file('projectImage')->getClientOriginalExtension(); // example: png, jpg ... etc
            $image_full_name = $image_name . '.' . $image_ext;
            // dd($image_full_name);
            $uploads_folder =  getcwd() .'/uploads/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
   
          $request->file('projectImage')->move($uploads_folder,$image_full_name);
          $image = Image::make( $uploads_folder .$image_full_name)->fit(1700,700);
          $image->save();
       

          $project->projectImage=$image_full_name;

      }
        // upload project wrapper and store it in database

      $project->projectName       = $request->input('projectName');
      $project->projectDesc       = $request->input('projectDesc');
      $project->projectCategoryId = 2;
    //   $project->projectCategoryId = $request->input('projectCategoryId');
      $project->projectText       = $request->input('projectText');
      $project->projectCost       = $request->input('projectCost');
      $project->projectLocation       = $request->input('projectLocation');
      $project->save();
      return redirect()->route('urgentprojects.index')->with('success','تم أضافة المشروع بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Projects::find($id);
      return view('dashboard.urgentprojects.edit')->with(['data'=>$data]);
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
       
        //   'projectCategoryId'  => 'required|numeric',
          'projectDesc'        => 'required',
          'projectText'        => 'required',
          'projectLocation'    => 'required',
          'projectCost'        => 'required|numeric',
      ]);
      
      // check if project status checked or not
      if($request->has('projectStatus') )
      {
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'projectStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'projectStatus'=>0,
        ]);
      }
      if($request->has('whatsapp')){
        \DB::table('projects')
        ->where('projectId',$id)
        ->update([
          'whatsapp'=>$request->input('whatsapp'),
        ]);
      }
      // upload project icon and store it in database
      if($request->file('projectIcon')){
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('projectIcon')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('projectIcon')->move($uploads_folder,$image_full_name);
          $image = Image::make( $uploads_folder . $image_full_name)->fit(1200,1200);
          $image->save();
          \DB::table('projects')
          ->where('projectId',$id)
          ->update([
            'projectIcon'=>$image_full_name,
          ]);
      }
      // upload project image and store it in database
      if($request->file('projectImage')){
          $image_name = time() . rand(1,1000000000000);
          $image_ext = $request->file('projectImage')->getClientOriginalExtension(); // example: png, jpg ... etc
          $image_full_name = $image_name . '.' . $image_ext;
          // dd($image_full_name);
          $uploads_folder =  getcwd() .'/uploads/';
          if (!file_exists($uploads_folder)) {
              mkdir($uploads_folder, 0777, true);
          }
          $request->file('projectImage')->move($uploads_folder,$image_full_name);
          $image = Image::make( $uploads_folder . $image_full_name )->fit(1700,700);
          $image->save();
          \DB::table('projects')
          ->where('projectId',$id)
          ->update([
            'projectImage'=>$image_full_name,
          ]);
      }
        

      \DB::table('projects')
      ->where('projectId',$id)
      ->update([
        'projectName'=>$request->input('projectName'),
        'projectDesc'=>$request->input('projectDesc'),
        'projectText'=>$request->input('projectText'),
        'projectCost'=>$request->input('projectCost'),
        'projectLocation'=>$request->input('projectLocation'),
      ]);

      return redirect()->route('urgentprojects.index')->with('success','تم تحديث المشروع بنجاح ');
          // return $request->all();
    }


    public function projectDetail($id)
    {
      $projectData = Projects::find($id);
      return view('pages.projectDetail')->with([
        'projectData'=>$projectData,
      ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // $filename = projects::find($id);
      // delete project by id
      if(intval($id)){
        // unlink(url('uploads/'.$filename->projectIcon));
        // unlink(url('uploads/'.$filename->projectImage));
        \DB::table('projects')
        ->where('projectId',$id)
        ->delete();
      }
      return redirect()->route('urgentprojects.index')->with('success','تم حذف المشروع بنجاح');
    }
}
