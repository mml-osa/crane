<?php

namespace App\Models\Profile;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcSocial extends Model
{
    use Notifiable;
    use uuidGenerator;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'alias', 'link', 'published', 'create_id', 'update_id',
    ];
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }
}
