<?php

namespace App\Http\Requests;

use App\Helpers\Constants\RulesHelper;
use Illuminate\Foundation\Http\FormRequest;

class TailorMadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 
     * @return array
     */
    public function rules()
    {
        return [
            // 'start_date' => ['nullable', 'date'],
            // 'end_date' => ['nullable', 'date'],
            // 'month' => ['nullable'],
            // 'days' => ['nullable'],
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email', 'max:254'],
            // 'phone' => ['nullable', 'string', 'max:255'],
            // 'adults' => ['nullable', 'min:0'],
            // 'children' => ['nullable', 'min:0'],
            // 'infants' => ['nullable', 'min:0'],
            // 'min_price' => ['nullable', 'min:0'],
            // 'max_price' => ['nullable', 'min:0'],
            // 'notes' => ['nullable', 'min:0'],
        ];
    }
}
