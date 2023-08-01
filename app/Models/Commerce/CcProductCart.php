<?php

namespace App\Models\Commerce;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcProductCart extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'quantity', 'create_id', 'update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc')->get();
    }

}
