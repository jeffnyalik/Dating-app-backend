<?php

namespace App\Http\Controllers\Photos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photos\PhotoResource;
use App\Models\Photos\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {   
        $res = PhotoResource::collection(Photo::all());
        return response(['photos' => $res], 200); 
    }

    public function store(Request $request)
    {
            $images= [];
            if($request->hasFile('photos'))
            {
                $images = $request->file('photos');
                foreach($images as $image)
                {
                    $name = time().rand(1, 100).'.'.$image->extension();
                    $images[] = $name;
                    $path = $image->storeAs('profile', $name, 'public');
                    
                    $res = new PhotoResource(
                        Photo::create([
                            'caption' => $request->caption,
                            'photos' => 'http://127.0.0.1:8000'.'/storage/'.$path,
                    
                        ])
                        );
                }
    
                return response(['pics' => $res], 201);
            }
      
    }

    public function removePhotos()
    {
        $data = PhotoResource::collection(Photo::all());
        $res = $data->delete();
        return response()->json($res, 204);

    }
}