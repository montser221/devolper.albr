<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publicReport extends Model
{
    use HasFactory;
    protected $primaryKey = 'reportId';
    protected $fillable = [
        'reportTitle','reportFile','imageFile'
    ];
}
