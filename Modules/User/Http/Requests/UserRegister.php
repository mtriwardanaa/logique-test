<?php

namespace Modules\User\Http\Requests;

use App\Helper\WrapperError;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegister extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'               => 'required|string',
            'address'            => 'required|string',
            'email'              => 'required|email:rfc,dns|unique:users',
            'password'           => 'required|string',
            'photos.*'           => 'required|image|distinct|mimes:jpeg,png,jpg|max:2048',
            'photos'             => 'required|array',
            'creditcard_type'    => 'required|string',
            'creditcard_number'  => 'required|string',
            'creditcard_name'    => 'required|string',
            'creditcard_expired' => 'required|string',
            'creditcard_cvv'     => 'required|string',
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

    protected function validate()
    {
        return $this->all();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(WrapperError::error(400, $validator->errors()->all()[0], 'field', $validator->errors()->keys()[0]));
    }
}
