<?php

namespace BenditaFome\Http\Requests;

use BenditaFome\Http\Requests\Request;

/**
 * Class CostumerCheckoutRequest
 * @package BenditaFome\Http\Requests
 */
class CostumerCheckoutRequest extends Request
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
        return [];
    }
}
