<?php

namespace App\Models\Media;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcMediaAlbum extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','alias','type_id','sub','sub_id','create_id','update_id','published',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function mainAlbum(){
        return $this->hasOne(CcMediaAlbum::class, 'id', 'sub_id');
    }

    //User RolesController Relations
    public function mediaAlbum(){
        return $this->hasMany(CcMediaAlbum::class, 'id', 'sub_id');
    }

    //User RolesController Relations
    public function medAlbum(){
        return $this->belongsTo(CcMediaAlbum::class, 'id', 'sub_id');
    }

    //User RolesController Relations
    public function mediaType(){
        return $this->belongsTo(CcMediaType::class, 'type_id', 'id');
    }

    //User RolesController Relations
    public function mediaItem(){
        return $this->hasOne(CcMediaItem::class, 'album_id', 'id');
    }

    //User RolesController Relations
    public function createdBy(){
        return $this->belongsTo(User::class, 'create_id', 'id');
    }

    //User RolesController Relations
    public function updatedBy(){
        return $this->belongsTo(User::class, 'update_id', 'id');
    }
}
