<?php

namespace App\Models\Media;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcMediaType extends Model
{
    use Notifiable;
    use uuidGenerator;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'alias', 'description','create_id','update_id',
    ];
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }
}
