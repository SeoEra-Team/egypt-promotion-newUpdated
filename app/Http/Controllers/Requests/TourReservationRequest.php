<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Constants\RulesHelper;

class TourReservationRequest extends FormRequest
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
            'name' => RulesHelper::REQUIRED_MID_STRING_VALIDATION,
            'email' => RulesHelper::REQUIRED_EMAIL_VALIDATION,
            'code' => RulesHelper::NULLABLE_SMALL_STRING_VALIDATION,
            'phone_number' => RulesHelper::NULLABLE_MID_STRING_VALIDATION,
            'date' => RulesHelper::REQUIRED_DATE_VALIDATION,

            'adults' => RulesHelper::REQUIRED_NUMBER_VALIDATION,
            'children' => RulesHelper::NULLABLE_NUMBER_VALIDATION,
            'infants' => RulesHelper::NULLABLE_NUMBER_VALIDATION,
            'message' => RulesHelper::NULLABLE_TEXT_VALIDATION,
        ];
    }
}
