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

class DeleteContact extends Action implements HasModel
{
    use HasModelTrait;

    public function __construct(Contact $contact)
    {
        $this->setModel($contact);
    }

    /**
     * Execute the action.
     *
     * @return void
     */
    public function handle()
    {
        $this->getModel()->delete();
    }
}
