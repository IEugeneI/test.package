<?php

namespace Eugene\ValidateVatNumberEu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProjectStatusRequest extends FormRequest
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
            'VAT' => 'required|string|regex:/^[a-zA-Z]{2}/',
            'companyName' => 'string',
            'address' => 'string',
            'includeRawResponse' => 'string',
        ];
    }
}
