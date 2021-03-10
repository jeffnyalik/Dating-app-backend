<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FakeModel extends Model
{
    protected $table = 'fake_models';
    protected $fillable = ['name', 'age'];
}
