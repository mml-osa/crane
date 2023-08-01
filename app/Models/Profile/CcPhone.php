<?php

namespace App\Models\Profile;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Commerce\CcProductCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcPhone extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','phone','main','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

    //Categories Relations
    public function mainCategory(){
        return $this->hasOne(CcProductCategory::class, 'id', 'cat_id');
    }
}
