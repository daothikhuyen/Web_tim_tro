<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Service\Users\AuthService;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(Request $request){

        $isExist = User::where('email', $request->input('email'))->exists();

        if($isExist){
            return response()->json([
                'error' => true,
                'message' => "Tài khoản đã tồn tại"
            ]);
       }else{
            $creatorOTP = $this->authService->signup($request);

            return response()->json([
                'error' => false,
                'otp' => $creatorOTP
            ]);
       }

    }

    public function is_activated(Request $request){

        $request = $this->authService->is_activated($request);
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

        if($user['is_activated'] != 1){
            return response()->json([
                'error' => true,
                'token' => "",
                'message' => 'Tài Khoản Của Bạn Đã Bị Khoá'
            ]);
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'error' => false,
            'user' => $user,
            'token' => $token
        ]);
    }

    public function getUser(){

        if(Auth::check() && Auth::user()->is_deleted == 0 && Auth::user()->is_activated == 1){
            return response()->json([
                'error' => false,
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'error' => true,
            'user' => ''
        ]);
    }


    public function logout(Request $request){

        $request->user()->tokens()->delete();
        return response()->json([
            'error' => false,
            'message'=> "Đăng xuất thành công"
        ]);

    }

    public function delete_account(){
        $user = Auth::user();

        $request = User::find($user->id);
        $result = $request->delete();

        return response()->json([
            'error' => $result?false:true,
        ]);
    }

    public function update(Request $request,User $user){

        $result = $this->authService->update($request,$user);

        return response()->json([
            'error' => $result?false:true,
        ]);
    }

    public function changePassword(Request $request){

        $user = Auth::user();
        if(Auth::check($request->input('current_pass'), $user->password)){

            $result = $this->authService->changePassword($request,$user->email);
            return response()->json([
                'error' => $result?false:true,
            ]);
        }else{
            return response()->json([
                'error' => true,
            ]);
        }
    }

    public function check_forgot_password(Request $request){

        try {
            $request->validate([
                'email' => 'required|exists:users'
            ]);

            if($request->user()){
                $request->user()->tokens()->delete();
            }

            $result = $this->authService->check_forgot_password($request);

            return response()->json([
                'error' => $result?false:true,
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
            ]);
        }

    }

    public function check_reset_password(Request $request) {

        $tokenData = PasswordResetToken::where('token',$request->token)->with('users')->first();

        if($tokenData){
            $data = $this->authService->changePassword($request,$tokenData->email);
            $tokenData->delete();

            return response()->json([
                'error' => $data?false:true,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }

    // admin
    public function list_user(){
        if(Auth::check()){
            $result = User::where('level', 2)
                            ->where('is_deleted',0)->paginate(10);

            if($result){
                $response = [
                    'paginate' => [
                        'total' => $result->total(),
                        'per_page' => $result->perPage(),
                        'current_page' => $result->currentPage(),
                        'last_page' => $result->lastPage(),
                        'from' => $result->firstItem(),
                        'to' => $result->lastItem()
                    ],
                    'data' => $result
                ];

                return response()->json($response);
            }

            return response()->json([
                'error' => true,
                'data' => ''
            ]);

        }
    }

    public function account_lock(Request $request, User $user){

        $user->is_activated = $request->is_activated;
        $user->save();
        return response()->json([
            'error' => false
        ]);
    }

    public function destroyAccount(Request $request, User $user){
        $user->is_deleted = 1;
        $user->save();
        return response()->json([
            'error' => false
        ]);
    }

    public function searchInput(Request $request){

        $result = $this->authService->searchInput($request[0]);

        if($result){
            return $result;
        }
    }

}
