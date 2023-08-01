<?php

namespace App\Models\Media;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcMediaItem extends Model
{
    use Notifiable;
    use uuidGenerator;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'album_id','title','alias','caption','content','url','file','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function mediaAlbum(){
        return $this->hasOne(CcMediaAlbum::class, 'id', 'album_id');
    }

    //User RolesController Relations
    public function medAlbum(){
        return $this->belongsTo(CcMediaAlbum::class, 'album_id', 'id');
    }

  //User RolesController Relations
  public function mainAlbum(){
    return $this->hasOne(CcMediaAlbum::class, 'id', 'sub_id');
  }
}
