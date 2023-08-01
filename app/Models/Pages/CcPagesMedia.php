<?php

namespace App\Models\Pages;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Media\CcMediaItem;
use App\Models\Media\CcMediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPagesMedia extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id','page_id','type_id','featured','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function mediaItem(){
        return $this->belongsTo(CcMediaItem::class, 'item_id', 'id');
    }

    //User RolesController Relations
    public function mediaType(){
        return $this->hasOne(CcMediaType::class, 'id', 'type_id');
    }
}
