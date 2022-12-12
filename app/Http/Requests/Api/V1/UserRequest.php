<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
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

            'name' => 'required|max:100',
             'email'=>'required|unique:users,email|email:rfc,dns',
             'phone' => 'required|numeric|unique:users,phone',
             'fb_token' => 'required',
             'password'=> 'required|confirmed'

		];
	}


	protected function onUpdate() {
		return [


            'name' => 'required|max:100',
             'email'=>'required|unique:users,email|email:rfc,dns',
             'phone' => 'required|numeric',
             'password'=> 'required|confirmed'
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
             'name'=>'name',
             'email'=>'email',
             'phone' => 'phone',
             'address'=> 'address',
             'password'=>'password',
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
