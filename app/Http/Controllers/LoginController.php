<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;


// use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth:sanctum')->only('logout');
    }

    
    public function logout()
    {
        
        Auth::user()->tokens()->delete();
        Auth::guard('web')->logout();
    
        return  redirect()->route('welcome');        
    }

    
    public function login(LoginRequest $req)
    {
        
        if(Auth::attempt(['email'=>$req->email ,'password'=>$req->password ]))
        { 
            $user=Auth::User();

            $token=$user->createToken(
                $user->name,
                ['*'],
                now()->addWeek() 
            )->plainTextToken;
            // return response()->json([$user,$token]);
            return redirect()->route('homepage');
        }
        else
            // return response()->json(['This email is not in our record']);

            return redirect()->route('welcome');
    }

    public function register(RegisterRequest $req)
    {
    

        $user=new User();
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email, 
            'password' => Hash::make($req->password),
            'role_name'=>"mumber"
        ]);
        $token=$user->createToken(
            $user->name,
            ['*'],
            now()->addWeek() // يضيف أسبوعًا إلى وقت الانتهاء
        )->plainTextToken;
        // dd($token);
        return  redirect()->route('welcome');

    }
}
