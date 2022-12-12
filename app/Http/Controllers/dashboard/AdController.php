<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Debts;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'logged out successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.login')->with($notification);
    }
    public function profile(){
        $id = Auth::id();
        $user = User::find($id);
        return view('admin.adminprofile',compact('user'));
    }

    public function edit_profile(){

        $id = Auth::id();
        $user = User::find($id);

        return view('admin.editprofile',compact('user'));
    }
    public function update_profile(Request $request){

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $user->profile_image = $filename;

        }
        $user->save();
        $notification = array(
            'message' => 'profile updated successfuly',
            'alert-type' => 'info'
        );
        return redirect()->route('admin.profile')->with($notification);

    }
    public function change_password(){
        return view('admin.changepassword');
    }

    public function update_password(Request $request){

        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword'
        ]);

        $hashpassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashpassword)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();

            $notification = array(
                'message' => 'password changed successfuly',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }else{
            $notification = array(
                'message' => 'old password does not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }



    public function delete($id){

        User::findOrFail($id)->delete();
        $notification = array(
            'message' => ' تم مسح المستخدم ',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function adduser(){

        return view('admin.adduser');

    }
    public function storeuser(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email|email:rfc,dns',
            'phone' => 'required|numeric',
            'personal_id' => 'required|numeric',
        ]);

        User::create($request->all());

        $notification = array(
            'message' => 'تم اضافة المستخدم',
            'alert-type' => 'info'
        );
        return redirect()->route('dashboard')->with($notification);



    }
    public function edituser($id){
        $user = User::findOrFail($id);

        return view('admin.edituser',compact('user'));


    }
    public function updateuser(Request $request){

        $request->validate([
            'email'=>'required|unique:users,email|email:rfc,dns',
            'phone' => 'required|numeric',
            'personal_id' => 'required|numeric',
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->personal_id = $request->personal_id;
        $user->save();
        $notification = array(
            'message' => 'تم تعديل المستخدم',
            'alert-type' => 'info'
        );
        return redirect()->route('dashboard')->with($notification);

    }
    //
}
