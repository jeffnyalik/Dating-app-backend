<?php

namespace App\Models\Gender;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
  protected $table = 'gender';
  protected $fillable = ['gender_name'];
}
