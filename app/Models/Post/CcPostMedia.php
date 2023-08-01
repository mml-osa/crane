<?php

namespace App\Models\Post;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Media\CcMediaItem;
use App\Models\Media\CcMediaType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPostMedia extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id','post_id','type_id','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function mediaItem(){
        return $this->hasOne(CcMediaItem::class, 'id', 'item_id');
    }

    //User RolesController Relations
    public function mediaType(){
        return $this->hasOne(CcMediaType::class, 'id', 'type_id');
    }
}
