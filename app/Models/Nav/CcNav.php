<?php

namespace App\Models\Nav;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Pages\CcPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcNav extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','alias','route','url','page_id','sub','order','parent_id','target_id','cat_id','target_id','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->get();
    }

    //User RolesController Relations
    public function navCat(){
        return $this->belongsTo(CcNavCat::class, 'cat_id', 'id');
    }

    //User RolesController Relations
    public function navPage(){
        return $this->hasOne(CcPage::class, 'id', 'page_id');
    }

    //User RolesController Relations
    public function navParent(){
        return $this->hasOne(CcNav::class, 'id', 'parent_id');
    }

    //User RolesController Relations
    public function navTarget(){
        return $this->hasOne(CcNavTarget::class, 'id', 'target_id');
    }
}
