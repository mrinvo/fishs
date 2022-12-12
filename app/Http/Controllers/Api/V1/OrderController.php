<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;


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
/////////////////////////////////////////////// user order //////////////////////////

    public function userstore(Request $request){

        $request->validate([

            'payment_id' => 'required|exists:payments,id',
            'address_id' => 'required|exists:addresses,id',
            'customer_name' => 'required|max:250',
            'customer_phone' => 'required|numeric',
            'total_price' => 'required|numeric',
            'notes'=>'max:500',
        ]);

        $user_id = $request->user()->id;
        $items = Item::where('user_id',$user_id)->where('order_id',null)->get();

        if(count($items) > 0){

        $order = Order::create([
            'user_id' => $user_id,
            'payment_id' => $request->payment_id,
            'address_id' => $request->address_id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'total_price' => $request->total_price,
            'notes' => $request->notes
        ]);




        foreach($items as $item){
            $item->update([
                'order_id' => $order->id,
            ]);
        }

        $response = [
            'message' => trans('api.orderstored'),
            'order items' => $items,
        ];
        $stat = 201;
        $title = 'عملية ناجحة';
        $body = 'تم ارسال طلبك بنجاح';

        $this->sendNotification($user_id,$title,$body);



        return response($response,$stat);
    }else{
        return response('you do not have any items' , 404);
    }


    }


    public function myorders(Request $request){
        $order = Order::with('items')->where('user_id',$request->user()->id)->get();
        $response = [
            'message' => trans('api.fetch'),
            'order items' => $order,
        ];
        $stat = 201;


        return response($response,$stat);
    }

    ///////////////////////////////////////////// guest order /////////////////////


    public function gueststore(Request $request){

        $request->validate([

            'uuid' => 'required',
            'payment_id' => 'required|exists:payments,id',
            'address' => 'required|max:250',
            'customer_name' => 'required|max:250',
            'customer_phone' => 'required|numeric',
            'total_price' => 'required|numeric',
            'notes' =>'max:500',

        ]);
        $items = Item::where('uuid',$request->uuid)->where('order_id',null)->get();

        if(count($items) > 0){





        $order = Order::create([
            'uuid' => $request->uuid,
            'payment_id' => $request->payment_id,
            'guest_address' => $request->address,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'total_price' => $request->total_price,
            'lat' => $request->lat,
            'long' => $request->long,
            'notes'=> $request->notes,
        ]);


        $items = Item::where('uuid',$request->uuid)->where('order_id',null)->get();

        foreach($items as $item){
            $item->update([
                'order_id' => $order->id,
            ]);
        }

        $response = [
            'message' => trans('api.orderstored'),
            'order items' => $items,
        ];
        $stat = 201;


        return response($response,$stat);
    }else{
        return response('you do not have any items',404);
    }

    }


    public function guestorders(Request $request){
        $order = Order::with('items')->where('uuid',$request->uuid)->get();
        $response = [
            'message' => trans('api.fetch'),
            'order items' => $order,
        ];
        $stat = 201;


        return response($response,$stat);

    }
}
