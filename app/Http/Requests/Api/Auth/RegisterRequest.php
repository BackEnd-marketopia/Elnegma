<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\UploadedFile;

/**
 * @property string $phone
 * @property string $type
 * @property string $code
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property UploadedFile $image
 * @property string $city_id
 * @property UploadedFile $card_image
 *
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response::api($validator->errors()->first(), 400, false, 400)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'       => 'required | string | max:255',
            'email'      => 'nullable | email | unique:users,email',
            'phone'      => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone',
            'code'       => 'nullable | numeric | digits:8',
            'image'      => 'nullable | image | max:2048',
            'password'   => 'required | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/',
            'city_id'    => 'required | exists:cities,id',
            'card_image' => 'required| image',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex'    => __('message.The phone number must start with 01 and contain exactly 11 digits'),
            'password.regex' => __('message.The password must contain at least one letter and at least one number'),
        ];
    }
}
