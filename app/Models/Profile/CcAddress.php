<?php

namespace App\Models\Profile;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Commerce\CcProductCategory;
use App\Models\Select\CcCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcAddress extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','address','postal','city','country','map','main','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //Categories Relations
    public function country_data(){
        return $this->hasOne(CcCountry::class, 'id', 'country');
    }
}
