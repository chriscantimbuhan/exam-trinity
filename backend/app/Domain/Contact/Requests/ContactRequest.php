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
            'first_name' => ['string', 'required'],
            'last_name' => ['string', 'required'],
            'suffix' => ['string'],
            'email' => ['email', 'required', new UniqueField($this->route(Contact::ROUTE_KEY) ?? new Contact)],
            'address' => ['string', 'required'],
            'zip_code' => ['string', 'required']
        ];
    }
}
