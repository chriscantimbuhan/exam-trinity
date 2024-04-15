<?php

namespace App\Domain\Contact\Actions;

use App\Actions\Action;
use App\Actions\HasFillable;
use App\Actions\HasFillableTrait;
use App\Actions\HasModel;
use App\Actions\HasModelTrait;
use App\Actions\HasRequestTrait;
use App\Actions\RequestAware;
use App\Domain\Contact\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreOrUpdateContact extends Action implements HasModel, RequestAware, HasFillable
{
    use HasModelTrait, HasRequestTrait, HasFillableTrait;

    public function __construct(Contact $contact = null)
    {
        $this->setModel($contact ?? new Contact);
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::transaction(function () {
            $this->getModel()->save();
        });

        return $this->getModel();
    }

    /**
     * Set values from request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function requestWasSet(Request $request)
    {
        $this->requestWasSetFromHasRequestTrait($request);
    }
}
