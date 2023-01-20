<?php

namespace App\Http\Requests;

use App\Helpers\HasEnsure;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserProfileUpdateRequest extends FormRequest
{
    use HasEnsure;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $this->ensureIsNotNullUser($this->user());

        return [
            'name' => ['string', 'max:255', 'nullable'],
            'surname' => ['string', 'max:255', 'nullable'],
            'favourite_number' => ['int', 'nullable'],
            'favourite_function' => ['string', 'max:255', 'nullable'],
            'description' => ['string', 'max:1023', 'nullable'],
            'sex' => ['string', 'max:255'],
        ];
    }
}
