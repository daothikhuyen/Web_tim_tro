<?php
namespace App\Http\Service\Users;

use App\Jobs\SendMail;
use App\Jobs\SendMail_ResetPass;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Models\verifytokens;
use Illuminate\Support\Facades\Auth;

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

            $user = User::where('email',$get_token->email)->first();
            $user->is_activated = 1;
            $user->save();

            $get_token->delete();

            if($get_token){
                return true;
            }
        }

    }

    public function update($request,$user){
        $user->fill($request->input());
        $user->save();

        return true;
    }

    public function changePassword($request,$email){
        $user = User::where('email',$email)->firstOrFail();
        $user->password = $request->new_password;
        $user->save();

        return true;
    }

    public function check_forgot_password($request){

        try {
            $user = User::where('email', $request->email)->first();

            $token = PasswordResetToken::where('email', $request->email)->get();

            if($token->isNotEmpty()){
                foreach ($token as $token) {
                    $token->delete();
                }
            }else{
                $token = \Str::random(50);
                $time = time();

                $tokenData = [
                    'email' => $request->email,
                    'token' => $token,
                ];


                if(PasswordResetToken::create($tokenData)){

                    SendMail_ResetPass::dispatch($user,$token);
                    return true;
                }
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function searchInput($request){
        // dd($request);
        if(Auth::check()){
            $user = Auth::user();

            if($request != null){
                $items = User::where('username', 'like', "%{$request}%")->paginate(10);

            }else{
                $items = User::where('user_id', $user->id)->paginate(10);
            }
            $response = [
                'paginate' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'from' => $items->firstItem(),
                    'to' => $items->lastItem()
                ],
                'data' => $items
            ];

            return response()->json($response);
        }
    }
}
