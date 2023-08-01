<?php

namespace App\Models\Select;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcCountry extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_code',
        'country_name',
        'currency_code',
        'fips_code',
        'zip_code',
        'iso_numeric',
        'north',
        'south',
        'east',
        'west',
        'capital',
        'continent_name',
        'continent',
        'languages',
        'iso_alpha3',
        'geoname_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('country_name', 'ASC')->get();
    }
}
