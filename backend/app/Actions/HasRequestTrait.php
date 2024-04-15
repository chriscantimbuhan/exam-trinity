<?php

namespace App\Actions;

use Illuminate\Http\Request;
use App\Support\RequestAwareTrait;

trait HasRequestTrait
{
    use RequestAwareTrait;

    /**
     * Method to notify that request is set.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function requestWasSet(Request $request)
    {
        $this->prepareUsingRequest($request);
    }

    /**
     * Prepare the action using the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function prepareUsingRequest(Request $request)
    {
        $this->setUserFromRequestIfAny($request);
        $this->setFillableValuesFromRequest($request);
    }

    /**
     * Alias for method requestWasSet. 
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function requestWasSetFromHasRequestTrait(Request $request)
    {
        $this->prepareUsingRequest($request);
    }


    /**
     * Set the user from the request instance (if logged in).
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function setUserFromRequestIfAny(Request $request)
    {
        if (
            $this instanceof HasUser
            && $request->user()
            && (! $this->hasUser())
        ) {
            $this->setUser($request->user());
        }
    }

    /**
     * Set the fill values from the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function setFillableValuesFromRequest(Request $request)
    {
        if ($this instanceof HasFillable) {
            $this->setFillableValues($request->input());
        }
    }
}
