<?php

namespace App\Models\Events;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcEvents extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id',
        'title',
        'alias',
        'caption',
        'content',
        'location',
        'organizer',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'phone',
        'email',
        'current',
        'expired',
        'link',
        'visibility_id',
        'published',
        'create_id',
        'update_id'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }
    
    //Categories Relations
    public function eventCat(){
        return $this->belongsTo(CcEventsCategory::class, 'cat_id', 'id');
    }
}
