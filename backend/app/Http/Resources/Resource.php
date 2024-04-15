<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\FormatDateAndTime;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    use FormatDateAndTime;

    /**
     * Apply formatting to the data.
     *
     * @param array $data
     * @return array
     */
    protected function applyFormatting(array $data)
    {
        return $this->formatDateAttributes($data);
    }

    /**
     * Create a missing value instance.
     *
     * @return \App\Http\Resources\MissingValue
     */
    protected function missingValue()
    {
        return new MissingValue;
    }
}
