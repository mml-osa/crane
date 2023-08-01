<?php

namespace App\Models\Auth;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Post\CcPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcUserProfile extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name','last_name','bio','avatar','create_id','update_id'
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //User RolesController Relations
    public function userPost(){
        return $this->hasMany(CcPost::class, 'user_id', 'user_id');
    }

}
