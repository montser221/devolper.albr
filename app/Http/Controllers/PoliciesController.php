<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\Models\Policies;
use Storage;
class PoliciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allpolicies = Policies::latest()->paginate(8);
        return view('dashboard.policies.index')->with(['allpolicies'=>$allpolicies]);
    }
    // associcFiles
    public function associcFiles()
    {
      $associcFiles = Policies::latest()->paginate(6);
        return view('pages.associcFiles')->with(['associcFiles'=>$associcFiles]);
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
          'policyTitle'        => 'required|unique:policies|max:255',
          'policyImage'        => 'required|mimes:png,jpg,jpeg,svg|max:5000',
          'policyFile'         => 'required|mimes:pdf',
      ]);
      // create policyImage instance
      $policy = new Policies;

      // check if policy status checked or not
      if($request->has('policyStatus')){
          $policy->policyStatus=1;
      }

      if($request->file('policyImage')){
        // upload policyImage icon and store it in database
         $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('policyImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/polices';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('policyImage')->move($uploads_folder,    $image_full_name);
        // $reportFiles->reportPdfFile=$image_full_name;
        // $path = Storage::putFile(getcwd().'/otherfile', $request->file('memFile'));
        //   $otherfiles->memFile=$image_full_name;
        //   $path = Storage::disk('public_path')->putFile('uploads/policies', $request->file('policyImage'));
          // $image = Image::make(Storage::path($path))->fit(1200,700);
          // $image->save();
          $policy->policyImage= "uploads/polices/".$image_full_name;
      }

      if($request->file('policyFile')){
        // upload policyImage icon and store it in database
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('policyFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/polices';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('policyFile')->move($uploads_folder,    $image_full_name);
        //   $path = Storage::disk('public_path')->putFile('uploads/policies', $request->file('policyFile'));
          
          // $image = Image::make(Storage::path($path))->fit(1200,700);
          // $image->save();
          $policy->policyFile= "/uploads/polices/".$image_full_name;
      }

      // $policy->policyLevel       = $request->input('policyLevel');
      $policy->policyTitle       = $request->input('policyTitle');
      $policy->save();
      return redirect()->route('policies.index')->with('success','تم أضافة السياسة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data = Policies::find($id);
      return view('dashboard.policies.edit')->with(['data'=>$data]);
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

      // check if policyStatus   checked or not
      if($request->has('policyStatus') )
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'policyStatus'=>1,
        ]);
      }
      else
      {
        \DB::table('policies')
        ->where('policyId',$id)
        ->update([
          'policyStatus'=>0,
        ]);
      }
  

      if($request->file('policyFile')){
        // // update policyImage icon and store it in database
        $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('policyFile')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/polices';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('policyFile')->move($uploads_folder,    $image_full_name);
        //   $path = Storage::disk('public_path')->putFile('uploads/policies', $request->file('policyFile'));
          // $image = Image::make(Storage::path($path))->fit(1200,700);
          // $image->save();
          \DB::table('policies')
          ->where('policyId',$id)
          ->update([
            'policyFile'=> "uploads/polices/".$image_full_name,
          ]);

      }
      if($request->file('policyImage')){
        // // upload policyImage icon and store it in database
        
        //   $path = Storage::disk('public_path')->putFile('uploads/policies', $request->file('policyImage'));
         $image_name = time() . rand(1,1000000000000);
        $image_ext = $request->file('policyImage')->getClientOriginalExtension(); // example: png, jpg ... etc
        $image_full_name = $image_name . '.' . $image_ext;

        $uploads_folder =  getcwd() .'/uploads/polices';
        if (!file_exists($uploads_folder)) {
            mkdir($uploads_folder, 0777, true);
        }
        $request->file('policyImage')->move($uploads_folder,    $image_full_name);
          // $image = Image::make(Storage::path($path))->fit(1200,700);
          // $image->save();
          \DB::table('policies')
          ->where('policyId',$id)
          ->update([
            'policyImage'=>"uploads/polices/".$image_full_name,
          ]);

      }
    
      \DB::table('policies')
      ->where('policyId',$id)
      ->update([
        'policyTitle'=>$request->input('policyTitle'),
      ]);

      return redirect()->route('policies.index')->with('success','تم تحديث  السياسة بنجاح   ');
          // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // delete policyImage by id
      if(intval($id)){
        Storage::delete(Policies::find($id)->policyImage);
        Storage::delete(Policies::find($id)->policyFile);
        \DB::table('policies')
        ->where('policyId',$id)
        ->delete();
      }
      return redirect()->route('policies.index')->with('success','تم حذف السياسة بنجاح ');
    }
}
