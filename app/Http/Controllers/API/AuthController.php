<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Intervention\Image\Laravel\Facades\Image;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5',
            'company' => 'required',
            'email' => 'email|required|unique:users',
            // 'password' => 'required|confirmed'
            'password' => 'required'
        ]);

        $validatedData['password'] = Hash::make($request->password);

        $user = User::create($validatedData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'User create successfully',
            'data' => ['user' => $user, 'access_token' => $accessToken]
        ], 201);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response()->json([
            'status' => false,
            'message' => 'User does not exist, please check your details',
            'error' => 'User does not exist, please check your details'
            ], 400);
        }
        
        if (auth()->user()->aktif!='1') {
            return response()->json([
            'status' => false,
            'message' => 'User belum diaktivasi, silahkan hubungi admin',
            'error' => 'User belum diaktivasi, silahkan hubungi admin'
            ], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successfully',
            'data' => ['user' => auth()->user(), 'access_token' => $accessToken]
        ], 200);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        
        return response()->json([
            'status' => true,
            'message' => 'Logout successfully'
        ], 200);
    }
    
    public function profileupdate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5',
            'tgllahir' => 'required',
            //'email' => 'email|required|unique:users',
            'company' => 'required',
            'phone' => 'required'
            //'filefoto' => 'required'
        ]);
        
        $id = auth()->user()->id;
        
        if($request->file('filefoto')!=''){
            //upload image
            $image = $request->file('filefoto');
            $image->storeAs('images1', $image->hashName());
            
            $img = Image::read($image)
                ->resize(150, 100,  function ($constraint) {
                    //$constraint->aspectRatio();
                    //$constraint->upsize();
                    });
                                
            $img->save('images/'.$image->hashName());
            
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->tgllahir = $request->input('tgllahir');
            $user->phone = $request->input('phone');
            $user->company = $request->input('company');
            $user->foto = $image->hashName();
            
            $user->save();
        }else{
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->tgllahir = $request->input('tgllahir');
            $user->phone = $request->input('phone');
            $user->company = $request->input('company');
            $user->save();
        }


        return response()->json([
            'status' => true,
            'message' => 'User create successfully',
            'data' => ['user' => $user]
        ], 201);
    }
}
