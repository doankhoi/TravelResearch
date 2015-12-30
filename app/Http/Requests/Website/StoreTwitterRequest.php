<?php

namespace App\Http\Requests\Website;

use App\Http\Requests\Request;

class StoreTwitterRequest extends Request
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
            'screen_name' => 'required|unique:tlist,screen_name'
        ];
    }
}
