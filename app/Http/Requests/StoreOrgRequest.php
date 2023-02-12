<?php

namespace App\Http\Requests;

use App\Models\Reg\Org;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrgRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['nullable'],
            'name' => ['string', 'required'],
            'level_type' => ['string', 'required'],
            'address_id' => ['nullable'],
            'description' => ['string','nullable'],
            'external_id' => ['string','nullable'],
            'vendor_id' => ['string','nullable'],
        ];
    }
}
