<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;

class OrderController extends Controller
{
    //
    public function sendNotification($user_id,$title,$body)
    {
        $firebaseToken = User::select(['fb_token'])->where('id',$user_id)->get();

        $SERVER_API_KEY = 'AAAARqbAuko:APA91bHFbceKOYUsvgvZa_39zkbIr9MrwvEuUA8usqzVSyQPP29zmNMyKeJSeHG5_Coc-7QpG5cFQBM83OaAsEoyQN5CnSQ5eImvlfnFzpItvKH4hTyIJepKQpgYXxZIVZ0aeaaDdBMV';

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);


    }
    public function indexnew(){
        $data = Order::where('status','new')->orderBy('id','DESC')->get();
        return view('admin.orders.indexnew',compact('data'));


    }

    public function indexdelivered(){
        $data = Order::where('status','delivered')->orderBy('id','DESC')->get();
        return view('admin.orders.indexdelivered',compact('data'));


    }

    public function details($id){
        $order = Order::findOrFail($id);


        return view("admin.orders.details",compact('order'));
    }

    public function status(Request $request){

        $order = Order::find($request->id);
        $order->update([
            'status' => $request->status,
        ]);

        if($order->user_id){

            if($request->status == 'delivered'){
                $user_id = $order->user_id;
                $title = 'عملية ناجحة';
                $body = 'جاري  تجهيز طلبك';

                $this->sendNotification($user_id,$title,$body);
            }

        }


        return redirect()->back();

    }
}
