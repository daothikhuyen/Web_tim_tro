<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Service\Users\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    protected $siginupservice;

    public function __construct(AuthService $siginUpService)
    {
        $this->siginupservice = $siginUpService;
    }

    public function signup(Request $request){

        $isExist = User::where('email', $request->input('email'))->exists();

        if($isExist){
            return response()->json([
                'error' => true,
                'message' => "Tài khoản đã tồn tại"
            ]);
       }else{
            $creatorOTP = $this->siginupservice->signup($request);

            return response()->json([
                'error' => false,
                'otp' => $creatorOTP
            ]);
       }

    }

    public function is_activated(Request $request){

        $request = $this->siginupservice->is_activated($request);
        if($request){
            return response()->json([
                'error' => false,
                'message' => "Đăng ký tài khoản thành công"
            ]);
       }else{
            return response()->json([
                'error' => true,
                'message' => "Mã OTP Chưa Chính Xác"
            ]);
       }
    }

    public function store(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ])){
            return response()->json([
                'error' => true,
                'token' => "",
                'message' => 'Thông tin không hợp lệ'
            ]);

        }

        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'error' => false,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function getUser(){

        return Auth::user();

    }


    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return response()->json([
            'error' => false,
            'message'=> "Đăng xuất thành công"
        ]);

    }
}
