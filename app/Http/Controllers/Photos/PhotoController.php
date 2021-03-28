<?php

namespace App\Http\Controllers\Photos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photos\PhotoResource;
use App\Models\Photos\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PhotoController extends Controller
{
    public function index()
    {   
        // $res = PhotoResource::collection(Photo::all());
        $res = Auth::user()->photos;
        return response()->json($res);
    }

    public function store(Request $request)
    {
            if($request->hasFile('photos'))
            {   
                $images = $request->file('photos');
                foreach($images as $image)
                {
                    $name = time().rand(1, 100).'.'.$image->extension();
                    $images = $name;
                    $path = $image->storeAs('profile', $name, 'public');
                    
                    $save = new Photo();
                    $save->caption = $request->caption;
                    $save->photos = 'http://127.0.0.1:8000'.'/storage/'.$path;
                    $save->save();
                }
                return response()->json($save, 201);
            }
      
    }

    public function removePhotos()
    {
        $data = PhotoResource::collection(Photo::all());
        $res = $data->delete();
        return response()->json($res, 204);

    }
}