<?php

namespace App\Models\Setting;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcLanding extends Model
{
    use Notifiable;
    use uuidGenerator;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state','bg','create_id','update_id',
    ];
}
