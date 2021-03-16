<?php

namespace App\Models\Photos;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table ='photos';
    protected $fillable = [
       'photos',
       'caption',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

}
