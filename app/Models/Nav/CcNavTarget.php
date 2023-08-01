<?php

namespace App\Models\Nav;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Pages\CcPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcNavTarget extends Model
{
   use Notifiable;
   use uuidGenerator;
   
   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
      'title','alias','code','published','create_id','update_id',
   ];
   
   public function scopeOrdered($query)
   {
      return $query->orderBy('created_at', 'asc')->get();
   }
}
