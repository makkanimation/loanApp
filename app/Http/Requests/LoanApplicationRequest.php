<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ApiResponse;

class LoanApplicationRequest extends FormRequest
{
    use ApiResponse;
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
            "loan_amount" =>" required|gte:20000|regex:/^\d+(\.\d{1,2})?$/",
            "num_of_emis" =>" required|integer|between: 12,72",
        ];
    }

    protected function failedValidation(Validator $validator) {
        $this->validationResponse($validator,422);
    }

}
