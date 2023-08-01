<?php

namespace App\Models\Post;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Auth\CcUserProfile;
use App\Models\Pages\CcPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPost extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id','title','alias','caption','content','link','file','views','view_id','visibility_id','published','create_date','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    //User RolesController Relations
    public function user(){
        return $this->belongsTo(User::class, 'create_id', 'id');
    }

    //User RolesController Relations
    public function userProfile(){
        return $this->belongsTo(CcUserProfile::class, 'create_id', 'user_id');
    }

    //User RolesController Relations
    public function userTable(){
        return $this->belongsTo(User::class, 'create_id', 'id');
    }

    //Categories Relations
    public function postCategory(){
        return $this->hasOne(CcPostCategory::class, 'id', 'cat_id');
    }

    //Categories Relations
    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'create_id');
    }

    //Categories Relations
    public function updatedBy(){
        return $this->hasOne(User::class, 'id', 'update_id');
    }

    //Post Media Relations
    public function postMedia(){
        return $this->hasOne(CcPostMedia::class, 'post_id', 'id');
    }

    //Post Media Relations
    public function postComment(){
        return $this->hasOne(CcPostComment::class, 'post_id', 'id');
    }
}
