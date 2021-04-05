<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;

class DoneController extends Controller
{

    public function Thanks(){
      
      return view('pages.done');
    }
}