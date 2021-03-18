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
        return $this->belongsTo(User::class, 'user_id');
    }

public function save(array $options = array())
{
    $this->user_id = auth()->id();
    parent::save($options);
}

}
