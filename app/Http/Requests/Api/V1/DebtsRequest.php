<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class DebtsRequest extends FormRequest
{	/**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize() {
       return true;
   }

   /**

    * Get the validation rules that apply to the request.
    *
    * @return array (onCreate,onUpdate,rules) methods
    */
   protected function onCreate() {
       return [


        'finance_type'=>'required|in:حكومي,بنوك,تجارية,أشخاص,',
        'finance_name'=> 'required|max:255',
        'finance_main_amount'=>'required|numeric',
        'benifits_amount'=>'required|numeric',
        'total_amount'=>'required|numeric',
        'notes'=>'max:255',

       ];
   }


   protected function onUpdate() {
       return [

        'finance_type'=>'required|in:حكومي,بنوك,تجارية,أشخاص,',
        'finance_name'=> 'required|max:255',
        'finance_main_amount'=>'required|numeric',
        'benifits_amount'=>'required|numeric',
        'total_amount'=>'required|numeric',
        'notes'=>'max:255',


       ];
   }

   public function rules() {
       return request()->isMethod('put') || request()->isMethod('patch') ?
       $this->onUpdate() : $this->onCreate();
   }


   /**

    * Get the validation attributes that apply to the request.
    *
    * @return array
    */
   public function attributes() {
       return [

        'finance_type'=>'finance_type',
        'finance_name'=> 'finance_name',
        'finance_main_amount'=>'finance_main_amount',
        'benifits_amount'=>'benifits_amount',
        'total_amount'=>'total_amount',
        'notes'=>'notes',
       ];
   }

   /**

    * response redirect if fails or failed request
    *
    * @return redirect
    */
   public function response(array $errors) {
       return $this->ajax() || $this->wantsJson() ?
       response([
           'status' => false,
           'StatusCode' => 422,
           'StatusType' => 'Unprocessable',
           'errors' => $errors,
       ], 422) :
       back()->withErrors($errors)->withInput(); // Redirect back
   }

}
