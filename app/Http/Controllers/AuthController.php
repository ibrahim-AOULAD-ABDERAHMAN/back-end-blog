<?php

namespace App\Http\Controllers;


use App\Http\Requests\Authentications\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Repository\AuthRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as requestFacades;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    // public function register(RegisterRequest $registerRequest)
    // {
    //     try{
    //         $data   = $registerRequest->only('email', 'phone_number', 'password', 'confirm_password');
    //         $result = $this->authRepository->register($data);
    //         return Response()->json(['data' => $result], 201);
    //     }catch(\Exception $errors){
    //         Log::error("Error *register AuthController*, IP: " . Request::getClientIp(true) . ", {$errors->getMessage()}");
    //         return response()->json(['errors' => $errors->getMessage()], 500);
    //     }
    // }

    public function login(LoginRequest $loginRequest)
    {
        try{
            $data   = $loginRequest->only('email', 'password');
            $result = $this->authRepository->login($data);
            if($result){
                return Response()->json(['data' => $result], 200);
            }else{
                return response()->json(['errors' => 'This email or pasword incorrect !'], 422);
            }
        }catch(\Exception $errors){
            Log::error("Error *register AuthController*, IP: " . requestFacades::getClientIp(true) . ", {$errors->getMessage()}");
            return response()->json(['errors' => $errors->getMessage()], 500);
        }
    }

    public function logout()
    {
        if(Auth::user()){
            Auth::user()->update(['last_login' => now()]);
            Auth::user()->tokens()->delete();
            return 'Logged out';
        }
        return 'Something wrong !';
    }
}
