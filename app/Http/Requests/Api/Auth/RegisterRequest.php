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
 * @property string $registration_id
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
            'name'            => 'required | string | max:255',
            'email'           => 'nullable | email | unique:users,email',
            'phone'           => 'required | digits:11 | regex:/^01\d{9}$/ | unique:users,phone',
            'registration_id' => 'nullable | string | max:255 | required_without:card_image',
            'image'           => 'nullable | image | max:2048',
            'password'        => 'required | min:8 | regex:/[A-Za-z]/ | regex:/[0-9]/',
            'city_id'         => 'required | exists:cities,id',
            'card_image'      => 'nullable | image | required_without:registration_id',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex'                    => __('message.The phone number must start with 01 and contain exactly 11 digits'),
            'password.regex'                 => __('message.The password must contain at least one letter and at least one number'),
            'registration_id.required_without' => __('message.Either registration ID or card image is required'),
            'card_image.required_without'    => __('message.Either card image or registration ID is required'),
        ];
    }
}
