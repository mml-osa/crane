<?php

namespace App\Models\Services;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcServicesCategory extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','alias','caption','description','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'ASC')->get();
    }

    //User RolesController Relations
    public function user(){
        return $this->belongsTo(User::class, 'role_id', 'id');
    }

    //User RolesController Relations
    public function service(){
        return $this->hasMany(CcServices::class, 'cat_id', 'id');
    }
}
