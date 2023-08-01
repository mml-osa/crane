<?php

namespace App\Models\Pages;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Auth\CcUserProfile;
use App\Models\Post\CcPostCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcContent extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id','cat_id','title','alias','caption','content','link','file','views','view_id','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function user(){
        return $this->belongsTo(CcPage::class, 'page_id', 'id');
    }

    //User RolesController Relations
    public function userProfile(){
        return $this->belongsTo(CcUserProfile::class, 'create_id', 'user_id');
    }

    //Categories Relations
    public function postCategory(){
        return $this->hasOne(CcPostCategory::class, 'id', 'post_cat_id');
    }
}
