<?php

namespace App\Domain\Contact\Requests;

use App\Domain\Contact\Models\Contact;
use App\Rules\UniqueField;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', new UniqueField($this->route(Contact::ROUTE_KEY) ?? new Contact)],
            'address' => ['required', 'string'],
            'zip_code' => ['required', 'string']
        ];
    }
}
