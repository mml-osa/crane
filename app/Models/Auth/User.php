<?php

namespace App\Models\Auth;


use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Post\CcPost;
use App\Models\Select\CcRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role_id', 'active', 'create_id', 'update_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function userRole(){
        return $this->hasOne(CcRole::class, 'id', 'role_id');
    }

    //User RolesController Relations
    public function userProfile(){
        return $this->hasOne(CcUserProfile::class, 'user_id', 'id');
    }

    //User RolesController Relations
    public function userPost(){
        return $this->hasMany(CcPost::class, 'id', 'create_id');
    }

    //User RolesController Relations
    public function createdBy(){
        return $this->belongsTo(User::class, 'id', 'create_id');
    }

    //User RolesController Relations
    public function updatedBy(){
        return $this->belongsTo(User::class, 'id', 'update_id');
    }
}
