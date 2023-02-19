<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'nullable'],
            'middle_name' => ['string', 'nullable'],
            'last_name' => ['string', 'nullable'],
            'preferred_name' => ['string', 'nullable'],
            'full_name' => ['string', 'nullable'],
            'pronouns' => ['string', 'nullable'],
            'birthdate' => ['date', 'nullable'],
            'phone' => ['string', 'nullable'],
            'email' => ['email', 'nullable'],
            'prefix' => ['string', 'nullable'],
            'suffix' => ['string', 'nullable'],
            'user_id' => ['integer', 'nullable'],
            'metadata' => ['string', 'nullable'],
            'external_id' => ['nullable'],
            'vendor_id' => ['nullable'],
        ];
    }
}
