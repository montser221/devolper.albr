<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
    use HasFactory;
    protected $primaryKey  = 'ReportId';
    protected $fillable = [
      'reportTitle',
      'reportImageFile',
      'reportPdfFile',
      'reportStatus'
    ];
}
