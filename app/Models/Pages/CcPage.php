<?php

namespace App\Models\Pages;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Nav\CcNav;
use App\Models\Select\CcVisibility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPage extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_id','name','alias','title','caption','route','description','visibility_id','password','parent','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

  //User RolesController Relations
  public function user(){
    return $this->belongsTo(User::class, 'create_id', 'id');
  }

  //Page Category Relations
  public function pageCategory(){
    return $this->hasOne(CcPagesCategory::class, 'id', 'cat_id');
  }

  //User RolesController Relations
  public function visibility(){
    return $this->belongsTo(CcVisibility::class, 'visibility_id', 'id');
  }

  //User RolesController Relations
  public function navigation(){
    return $this->hasOne(CcNav::class, 'page_id', 'alias');
  }

  //Post Media Relations
  public function pageMedia(){
    return $this->hasOne(CcPagesMedia::class, 'page_id', 'id');
  }

  //Post Media Relations
  public function pageBanner(){
    return $this->hasMany(CcPagesMedia::class, 'page_id', 'id');
  }

  //Post Media Relations
  public function pageIcon(){
    return $this->hasMany(CcPagesMedia::class, 'page_id', 'id');
  }
}
