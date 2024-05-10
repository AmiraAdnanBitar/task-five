<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;



class LoginController extends Controller
{
    use ApiResponceTrait;
    public function __construct()
    { 
        $this->middleware('auth:sanctum')->only('logout');
    }

    
    public function logout()
    { 
        auth()->user()->tokens()->delete();
    
        
        // return response()->json([
        //             'message' => 'Successfully logged out',
        //         ]);
        return  $this->LoginResponse(null,null,'Successfully logged out');
        
    }

    
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
    
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 422);
        
        if(Auth::attempt(['email'=>$req->email ,'password'=>$req->password ]))
        { 
            $user=Auth::User();

            $token=$user->createToken(
                $user->name,
                ['*'],
                now()->addWeek() 
            )->plainTextToken;
    

            return $this->LoginResponse($user,$token,'logged in');
            // return response()->json([$user,$token]);
        }
        else
            return  $this->LoginResponse(null,null,'This email is not in our record');
            // return response()->json(['This email is not in our record']);

    }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'name' => 'required|string|max:255',
    
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 422);
    
        $user=new User();
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email, 
            'password' => Hash::make($req->password),
        ]);

    
        $token=$user->createToken(
            $user->name,
            ['*'],
            now()->addWeek() // يضيف أسبوعًا إلى وقت الانتهاء
        )->plainTextToken;
        return  $this->LoginResponse($user ,$token ,'User created');
        // return response()->json([
        
        //     'msg'=>'User created',
        //     'user'=>$user ,
        //     'token'=>$token 
        // ] ,200);

    }

    
}
