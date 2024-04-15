<?php

namespace App\Domain\Contact\Controllers;

use App\Domain\Contact\Actions\DeleteContact;
use App\Domain\Contact\Actions\StoreOrUpdateContact;
use App\Domain\Contact\Models\Contact;
use App\Domain\Contact\Requests\ContactRequest;
use App\Domain\Contact\Resources\ContactResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ContactResource::collection((new Contact)->get()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Domain\Contact\Requests\ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $model = (new StoreOrUpdateContact)
            ->setRequest($request)
            ->execute();

        return response()->json(new ContactResource($model));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Domain\Contact\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {            
        return response()->json(new ContactResource($contact));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Domain\Contact\Requests\ContactRequest $request
     * @param \App\Domain\Contact\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $model = (new StoreOrUpdateContact($contact))
            ->setRequest($request)
            ->execute();

            return response()->json(new ContactResource($model));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Domain\Contact\Models\Contact $contact
     * @return void
     */
    public function destroy(Contact $contact)
    {
        (new DeleteContact($contact))
            ->execute();
    }
}
