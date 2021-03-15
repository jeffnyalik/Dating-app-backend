<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Photos\PhotoResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Photos\Photo;
use App\User;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $request['type'] = $request['type'] ? $request['type']  : 0;
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                return response(['token' => $token, 'user' => $user]);
            } else {
                $response = ["message" => "Invalid email or password"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    // public function getUser(Request $request){
    //     return $request->user();
    // }

    public function getProfile()
    {   
        $profile = new UserResource(Auth::user());
        return response(['profile' => $profile], 200);
    }

    public function updateProfile(Request $request)
    {   
        $data = Auth::user();
        $data->city = $request->input('city');
        $data->name = $request->input('name');
        $data->known_as = $request->input('known_as');
        $data->bio = $request->input('bio');
        $data->looking_for = $request->input('looking_for');
        $data->last_active = $request->input('last_active');
        $data->interests = $request->input('interests');
        $data-> language = $request->input('language');
        $data->dob = $request->input('dob');
        $data->country_id = $request->input('country_id');
        $data->gender_id = $request->input('gender_id');
        
        
       
        if($request->hasFile('image'))
        {
            $destination = basename('pics'.$data->image);
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $name = time().rand(1, 100).'.'.$file->extension();
            $path = $file->storeAs('pics', $name, 'public');
            $data->image = 'http://127.0.0.1:8000'.'/storage/'.$path;
        }

        $data->save();
        return new UserResource(Auth::user());

       
    }

    public function allUsers()
    {
        $users = UserResource::collection(User::all());
        return response(['users' => $users], 201);
    }

}
