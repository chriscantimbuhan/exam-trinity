<?php

namespace App\Http\Resources\Concerns;

use Carbon\Carbon;

trait FormatDateAndTime
{
    /**
     * @var array
     */
    protected $dates = [];

    /**
     * @var array
     */
    protected $datetimes = ['created_at', 'updated_at'];

    /**
     * Merge the attributes that should be formatted using the application-wide date format.
     * 
     * @param array $data
     * @return array
     */
    protected function formatDateAttributes(array $data)
    {
        // Format date only attributes first then datetime
        foreach ($this->dates as $attr) {
            if (isset($data[$attr]) && $data[$attr] instanceof Carbon) {
                $data[$attr] = $this->formatDate($data[$attr]);
            }
        }

        foreach ($this->datetimes as $attr) {
            if (isset($data[$attr]) && $data[$attr] instanceof Carbon) {
                $data[$attr] = $this->formatDateTime($data[$attr]);
            }
        }

        return $data;
    }

    /**
     * Format the value as datetime.
     * 
     * @param \Carbon\Carbon|string|null $value
     * @return string
     */
    protected function formatDateTime($value)
    {
        if (is_null($value)) {
            return $this->missingValue();
        }

        if (! ($value instanceof Carbon)) {
            return Carbon::parse($value)->toDateTimeString();   
        } else {
            return $value->toDateTimeString();
        }
    }

    /**
     * Format the value as date.
     * 
     * @param \Carbon\Carbon|string $value
     * @return string
     */
    protected function formatDate($value)
    {
        if (is_null($value)) {
            return $this->missingValue();
        }

        if (! ($value instanceof Carbon)) {
            return Carbon::parse($value)->toDateString();   
        } else {
            return $value->toDateString();
        }
    }
}
