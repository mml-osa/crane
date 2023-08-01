<?php

namespace App\Models\Team;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Post\CcPost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcTeamCategory extends Model
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
      return $query->orderBy('created_at', 'asc')->get();
   }
   
   //User RolesController Relations
   public function createdBy(){
      return $this->belongsTo(User::class, 'create_id', 'id');
   }
   
   //User RolesController Relations
   public function team(){
      return $this->hasMany(CcTeam::class, 'cat_id', 'id');
   }
   
   //User RolesController Relations
   public function updatedBy(){
      return $this->belongsTo(User::class, 'update_id', 'id');
   }
}
