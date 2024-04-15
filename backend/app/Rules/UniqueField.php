<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueField implements Rule
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new rule instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function __construct($model)
    {            
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->exists($attribute, $value)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }

    /**
     * Check if email exists
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    protected function exists($attribute, $value)
    {
        $data = $this->model->where($attribute, $value)->first();

        if (! $data) {
            return false;
        }

        if ($data->getKey() == $this->model->getKey()) {
            return false;
        }

        return true;
    }
}
