<?php
namespace App\Http\Service\Users;

use App\Jobs\SendMail;
use App\Models\User;
use App\Models\verifytokens;

class AuthService {
    public function signup($request){

        $query = User::create([
            'username'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password'),
            'level'=> '2'
           ]);

        if($query){
            $otp = mt_rand(1000, 9999);

            $get_otp = new verifytokens();
            $get_otp->token =$otp;
            $get_otp->email = $request->input('email');
            $get_otp->save();

            SendMail::dispatch($request->input('email'),$otp);

            return  $otp;
        }


    }

    public function is_activated($request){

        $get_token = verifytokens::where('token',$request->input('token'))
                                ->where('email',$request->input('email'))->first();

        if($get_token){
            $get_token->is_activated = 1;
            $get_token->save();

            $user = User::where('email',$get_token->email)->first();
            $user->is_activated = 1;
            $user->save();

            $getting_token =verifytokens::where('token',$request->input('token'))
                            ->where('email',$request->input('email'))->first();
            $getting_token->delete();

            if($getting_token){
                return true;
            }
        }

    }
}
