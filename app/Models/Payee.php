<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    use HasFactory;
    protected $primaryKey  ='payeeId';
    protected $fillable = [
      'firstName','fatherName','grandFatherName','lastName',
      'socialState','ssnNumber','natonality','bestContactTime','email','gender',
      'birthDate','jobTitle','jobEmployer','address','phone'
    ];
}
