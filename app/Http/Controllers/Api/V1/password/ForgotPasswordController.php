<?php

namespace App\Http\Controllers\Api\V1\password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    //

         /**
       * Write code on Method
       *
       * @return response()
       */


      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $token = rand(0000,9999);

        //   DB::table('password_resets')->insert([
        //       'email' => $request->email,
        //       'token' => $token,
        //       'created_at' => Carbon::now()
        //     ]);

        //   Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
        //       $message->to($request->email);
        //       $message->subject('Reset Password');
        //   });

        $response = [

            'Message' => trans('api.emailsent'),
            'verify code' => $token,

        ];


        return response($response,201);


      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function SubmitCode($token) {
         return;
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login')->with('message', 'Your password has been changed!');
      }
}
