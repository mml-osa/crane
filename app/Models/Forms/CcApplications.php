<?php

namespace App\Models\Forms;

use App\Console\Commands\Traits\uuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcApplications extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','phone','location','course','notes',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->get();
    }
}
