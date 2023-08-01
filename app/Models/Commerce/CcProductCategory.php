<?php

  namespace App\Models\Commerce;

  use App\Console\Commands\Traits\uuidGenerator;
  use App\Models\Auth\User;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Notifications\Notifiable;

  class CcProductCategory extends Model
  {
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'sub_cat_id', 'title', 'alias', 'caption', 'content', 'discount', 'promo', 'featured', 'published', 'create_id', 'update_id',
    ];

    public function scopeOrdered($query)
    {
      return $query->orderBy('created_at', 'desc')->get();
    }

    //Categories Relations
    public function products(){
      return $this->hasMany(CcProduct::class, 'cat_id', 'id');
    }

    //Categories Relations
    public function subCategory(){
      return $this->hasMany(CcProductCategory::class, 'cat_id', 'id');
    }

    //Categories Relations
    public function createdBy()
    {
      return $this->hasOne(User::class, 'id', 'create_id');
    }

    //Categories Relations
    public function updatedBy()
    {
      return $this->hasOne(User::class, 'id', 'create_id');
    }

  }
