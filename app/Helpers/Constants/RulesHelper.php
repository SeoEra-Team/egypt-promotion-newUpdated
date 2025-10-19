<?php

namespace App\Helpers\Constants;

class RulesHelper
{
    //STRING
    const REQUIRED_SMALL_STRING_VALIDATION = ['required', 'string' , 'max:50'];
    const REQUIRED_MID_STRING_VALIDATION = ['required', 'string' , 'max:100'];
    const REQUIRED_STRING_VALIDATION = ['required', 'string' , 'max:255'];
    const REQUIRED_TEXT_VALIDATION = ['required', 'string'];

    const NULLABLE_SMALL_STRING_VALIDATION = ['nullable' , 'string', 'max:50'];
    const NULLABLE_MID_STRING_VALIDATION = ['nullable' , 'string', 'max:100'];
    const NULLABLE_STRING_VALIDATION = ['nullable' , 'string', 'max:255'];
    const NULLABLE_TEXT_VALIDATION = ['nullable' , 'string'];

    // GLOBAL VALIDATION RULES
    const REQUIRED_VALIDATION = ['required'];
    const NULLABLE_VALIDATION = ['nullable'];

    // EMAIL
    const REQUIRED_EMAIL_VALIDATION = ['required', 'email'];
    const NULLABLE_EMAIL_VALIDATION = ['nullable', 'email'];

    // NUMBER
    const REQUIRED_NUMBER_VALIDATION = ['required', 'numeric'];
    const NULLABLE_NUMBER_VALIDATION = ['nullable', 'numeric'];

    // NUMBER
    const NULLABLE_NUMERIC_VALIDATION = ['nullable', 'numeric'];

    const REQUIRED_INTEGER_VALIDATION = ['required', 'integer'];
    const NULLABLE_INTEGER_VALIDATION = ['nullable', 'integer'];

    // ADMIN PASSWORD
    const REQUIRED_ADMIN_PASSWORD_VALIDATION = ['required' ,'string', 'confirmed', 'min:6'];
    const NULLABLE_ADMIN_PASSWORD_VALIDATION = ['nullable' ,'string', 'confirmed', 'min:6'];

    // GENDER
    const REQUIRED_GENDER_VALIDATION = ['required', 'numeric', 'in:0,1'];
    const NULLABLE_GENDER_VALIDATION = ['nullable', 'numeric', 'in:0,1'];

    // DATE
    const NULLABLE_DATE_VALIDATION = ['nullable', 'date'];
    const REQUIRED_DATE_VALIDATION = ['required', 'date'];
    const REQUIRED_START_DATE_VALIDATION = ['required', 'date'];
    const NULLABLE_END_DATE_VALIDATION = ['nullable', 'date', 'after_or_equal:start_date'];
    const REQUIRED_END_DATE_VALIDATION = ['required', 'date', 'after_or_equal:start_date'];

    const NULLABLE_TIME_VALIDATION = ['nullable', 'date_format:H:i'];
    const NULLABLE_DATE_TIME_VALIDATION = ['nullable', 'date_format:Y-m-d H:i:s'];
    // Image
    const REQUIRED_IMAGE_VALIDATION = ['required','max:1024'];
    const NULLABLE_IMAGE_VALIDATION = ['nullable','max:1024'];

    // File
    const REQUIRED_FILE_VALIDATION = ['required', 'file', 'max:1024'];
    const NULLABLE_FILE_VALIDATION = ['nullable', 'file', 'max:1024'];

    // URL
    const NULLABLE_URL_VALIDATION = ['nullable', 'string', 'max:191', 'url'];
    const REQUIRED_URL_VALIDATION = ['required', 'string', 'max:191', 'url'];

    const REQUIRED_ARRAY_VALIDATION = ['required', 'array'];
    // icon
    const REQUIRED_ICON_VALIDATION = ['required', 'string', 'max:255'];
    const NULLABLE_ICON_VALIDATION = ['nullable', 'string'];
}
