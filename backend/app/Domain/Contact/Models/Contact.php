<?php

namespace App\Domain\Contact\Models;

use App\Services\Description\Description;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Contact extends Model
{
    use HasFactory;

    const ROUTE_KEY = 'contact';

    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
        'email',
        'address',
        'zip_code'
    ];

    /**
     * Get description from API
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        $locator = new Description();

        $locator->getOne($this);

        return Cache::get('description')->get($this->getKey());
    }

    /**
     * Get full_name attribute
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $name = $this->first_name . ' ' . $this->last_name;

        if ($this->suffix) {
            return $name . ' ' . $this->suffix;
        }

        return $name;
    }
}
