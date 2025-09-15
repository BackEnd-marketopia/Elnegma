<?php

namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required | max:255',
            'title_ar' => 'nullable | max:255',
            'description' => 'required',
            'description_ar' => 'nullable',
            'image' => 'required',
            'start_date' => 'required | date',
            'end_date' => 'required | date',
        ];
    }
}
