<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
{
    public function __construct()
    {
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

}
