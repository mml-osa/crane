<?php

namespace App\Models\Services;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Auth\CcUserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcServices extends Model
{
  use Notifiable;
  use uuidGenerator;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'cat_id', 'name', 'title', 'alias', 'caption', 'content', 'link', 'file', 'visibility_id', 'published', 'create_id', 'update_id',
  ];

  public function scopeOrdered($query)
  {
    return $query->orderBy('created_at', 'asc')->get();
  }

  //User RolesController Relations
  public function user()
  {
    return $this->belongsTo(User::class, 'role_id', 'id');
  }

  //User RolesController Relations
  public function userTable()
  {
    return $this->belongsTo(User::class, 'create_id', 'id');
  }

  //User RolesController Relations
  public function userProfile()
  {
    return $this->belongsTo(CcUserProfile::class, 'create_id', 'user_id');
  }

  //Categories Relations
  public function serviceCategory()
  {
    return $this->hasOne(CcServicesCategory::class, 'id', 'cat_id');
  }

  //Post Media Relations
  public function serviceMedia()
  {
    return $this->hasOne(CcServicesMedia::class, 'service_id', 'id');
  }

  //Post Media Relations
  public function serviceBanner()
  {
    return $this->hasMany(CcServicesMedia::class, 'service_id', 'id');
  }
}
