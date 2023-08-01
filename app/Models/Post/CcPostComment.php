<?php

namespace App\Models\Post;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPostComment extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id','name','email','location','comment','reply','avatar','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //Post Media Relations
    public function commentPost(){
        return $this->hasOne(CcPost::class, 'id', 'post_id');
    }

    //Post Media Relations
    public function postComment(){
        return $this->hasOne(CcPostComment::class, 'comment_id', 'id');
    }
}
