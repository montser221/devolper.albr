<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    use HasFactory;
    protected $primaryKey = 'videoId';
    protected $fillable = [
      'videoTitle','videoLink','videoStatus','videoIcon'
    ];
}
