<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserRequest;
use App\Models\Rule;
use App\Models\User;
use App\Models\Verfication;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function Register(UserRequest $request){


        $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'verified' => 0,
            'fb_token' => $request->fb_token,
            'password' => bcrypt($request->password)

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $vf_code = $this->generateOtp($request->email);

        if($vf_code){
            $vf_msg = 'Verification code has been sent to your email';
        }else{
            $vf_msg = 'no code generated';
        }


        $response = [

            'Message' => 'registerd successfuly',
            'otp message' => $vf_msg,
            'data'=> $user,
            'token' => $token,

            'verify code' => $vf_code->otp_code,


        ];


        return response($response,201);


    }

    public function generateOtp($email){
        $user = User::where('email',$email)->first();
        $code = Verfication::where('user_id',$user->id)->latest()->first();

        $current_time =Carbon::now();

        if(!$user){

            return response('we cant find your email',404);


        }

        if($code && $current_time->isBefore($code->expire_ate)){

            return $code;

        }


        return Verfication::create([
            'user_id' => $user->id,
            'otp_code' => rand(1000, 9999),
            'expire_at' => Carbon::now()->addMinutes(10),
        ]);
    }
    public function verify(Request $request){

        $request->validate([
            'vf_code' => 'required|exists:verfications,otp_code'
        ]);


        $otp = Verfication::where('user_id',$request->user()->id)->where('otp_code',$request->vf_code)->latest()->first();
        $now = Carbon::now()->addHours(2);

        // if($otp && $now->isAfter($otp->expire_at)){

        //     return response('otp is not valid',422);

        // }

        if($otp){
            $user = User::where('id',$request->user()->id)->first();
            $user->verified = 1;
            $user->save();



            $response = [

                'Message' => trans('api.emailverified'),
            ];

            return response($response,201);
        }else{

            return response(trans('api.notfound'),422);
        }





    }


    public function ForgetPasswordEmail(Request $request){

        $request->validate([
            'email' => 'required|exists:users,email',
        ]);

        $user = User::where('email',$request->email)->first();
        $vf_code = $this->generateOtp($user->email);

        if($vf_code){

            $response = [

                'Message' => trans('api.emailsent'),

                'verify code' => $vf_code->otp_code,


            ];


            return response($response,201);
        }
    }

    public function ResetPassword(Request $request){

        $request->validate([

            'password' => 'required|confirmed',

        ]);

        $user = User::find($request->user()->id)
        ->update(['password' => Hash::make($request->password)]);

        $response = [
            'Message' => trans('api.stored'),

            'user_data' => $user,

        ];


        return response($response,201);

    }




    public function resetverify(Request $request){

        $request->validate([
            'vf_code' => 'required|exists:verfications,otp_code',
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email',$request->email)->first();
        $otp = Verfication::where('user_id',$user->id)->where('otp_code',$request->vf_code)->latest()->first();
        $now = Carbon::now()->addHours(2);

        // if($otp && $now->isAfter($otp->expire_at)){

        //     return response('otp is not valid',422);

        // }

        if($otp){

            $token = $user->createToken('myapptoken')->plainTextToken;
            $user->verified = 1;
            $user->save();

            $response = [

                'Message' => trans('api.emailverified'),
                'user' => $user,
                'token' => $token,
            ];

            return response($response,201);
        }else{


            $response = [

                'verified' => 0,

                'Message' => trans('api.notfound'),
            ];

            return response($response,422);
        }





    }

    public function rules(){
        $rules = Rule::find(1);

        $response = [
            'status' => true,
            'StatusCode' => 201,
            'message' => 'your rules and personal id key ',
            'data' => $rules,

        ];

        return response($response,201);
    }

    public function updaterules(Request $request){

        $request->validate([
            'key' => 'required|boolean',
            'rules' => 'required'

        ]);

        $data = Rule::find(1);

            $data->key = $request->key;
            $data->rules = $request->rules;



        $data->save();

        $response = [
            'status' => true,
            'StatusCode' => 201,
            'message' => 'your rules and personal id key are updated ',
            'data' => $data,

        ];

        return response($response,201);



    }

    public function login(Request $request){
        $fields = $request->validate([


            'user' => 'required',
            'password' => 'required|string|',
            'fb_token' => 'required',

        ]);

        $user = User::where('email',$fields['user'])
        ->orWhere('phone',$fields['user'])
        ->first();
        //check email


        //check password
        if(!$user || !Hash::check($fields['password'], $user->password)){

            return response([
                'message' => 'wrong login information'
            ],401);

        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $user->update([
            'fb_token' => $request->fb_token,
        ]);

        $response = [
            'message' => 'logged in successfuly',
            'user' => $user,
            'token' => $token,
        ];

        return response($response,201);
    }


    public function logout(Request $request){
        $request->validate([
            'destroy' => 'required|boolean',
        ]);
        if($request->destroy == 0){
            auth()->user()->tokens()->delete();
            $fb = User::find($request->user()->id);
            $fb->fb_token = null;


            return [
                'messege' =>'Logged out'
            ];

        }else{
            auth()->user()->tokens()->delete();

            User::find($request->user()->id)->delete();
            return [
                'messege' =>'user deleted'
            ];


        }

    }

    public function profile(Request $request){

        $user = User::findOrFail($request->user()->id);

        $response = [
            'message' => trans('api.fetch'),
            'user' => $user,
        ];

        return response($response,201);



    }

    public function updateprofile(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);

        $user = User::findOrFail($request->user()->id);

        $emails = User::select([
            'email'
        ])->where('email','!=',$user->email)->get();

        foreach ($emails as $email) {

            if($email == $request->email){
                return response('this email already exists',422);
            }
        }

        $phones = User::select([
            'phone'
        ])->where('phone','!=',$user->phone)->get();

        foreach ($phones as $phone) {

            if($phone == $request->phone){
                return response('this phone already exists',422);
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $response = [
            'message' => trans('api.stored'),
            'user' => $user,
        ];

        return response($response,201);

    }


    //





}
