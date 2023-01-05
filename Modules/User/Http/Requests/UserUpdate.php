<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserUpdate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'            => 'required|numeric',
            'name'               => 'sometimes|required|string',
            'address'            => 'sometimes|required|string',
            'email'              => 'sometimes|required|email:rfc,dns|unique:users',
            'password'           => 'sometimes|required|string',
            'photos.*'           => 'sometimes|required|image|distinct|mimes:jpeg,png,jpg|max:2048',
            'photos'             => 'sometimes|required|array',
            'creditcard_type'    => 'sometimes|required|string',
            'creditcard_number'  => 'sometimes|required|string',
            'creditcard_name'    => 'sometimes|required|string',
            'creditcard_expired' => 'sometimes|required|string',
            'creditcard_cvv'     => 'sometimes|required|string',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(WrapperError::error(400, $validator->errors()->all()[0], 'field', $validator->errors()->keys()[0]));
    }
}
