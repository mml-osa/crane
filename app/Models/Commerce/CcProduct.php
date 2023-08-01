<?php

namespace App\Models\Commerce;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Auth\CcUserProfile;
use App\Models\Post\CcPostMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcProduct extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','alias','cat_id','caption','content','price','discount','promo_start','promo_end','quantity','featured','visibility_id','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    //User RolesController Relations
    public function productReview(){
        return $this->hasMany(CcProductReview::class, 'product_id', 'id');
    }

    //Categories Relations
    public function category(){
        return $this->hasOne(CcProductCategory::class, 'id', 'cat_id');
    }

    //Categories Relations
    public function subCategory(){
        return $this->hasOne(CcProductCategory::class, 'id', 'sub_cat_id');
    }

    //Post Media Relations
    public function productMedia(){
        return $this->hasOne(CcPostMedia::class, 'id', 'post_id');
    }

  //User RolesController Relations
  public function user(){
    return $this->belongsTo(User::class, 'create_id', 'id');
  }

  //User RolesController Relations
  public function userProfile(){
    return $this->belongsTo(CcUserProfile::class, 'create_id', 'user_id');
  }

  //Categories Relations
  public function createdBy(){
    return $this->hasOne(User::class, 'id', 'create_id');
  }

  //Categories Relations
  public function updatedBy(){
    return $this->hasOne(User::class, 'id', 'create_id');
  }
}
