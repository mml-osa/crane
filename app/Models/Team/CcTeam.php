<?php

namespace App\Models\Team;

use App\Console\Commands\Traits\uuidGenerator;
use App\Models\Auth\User;
use App\Models\Auth\CcUserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CcTeam extends Model
{
    use Notifiable;
    use uuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','position','cat_id','email','bio','phone','facebook','twitter','instagram','linked','youtube','published','create_id','update_id',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc')->get();
    }

    //User RolesController Relations
    public function user(){
        return $this->belongsTo(User::class, 'role_id', 'id');
    }

   //User RolesController Relations
   public function userProfile(){
      return $this->belongsTo(CcUserProfile::class, 'create_id', 'user_id');
   }

   //User RolesController Relations
   public function userTable(){
      return $this->belongsTo(User::class, 'create_id', 'id');
   }

   //Categories Relations
   public function teamCategory(){
      return $this->hasOne(CcTeamCategory::class, 'id', 'cat_id');
   }

   //Categories Relations
   public function createdBy(){
      return $this->hasOne(User::class, 'id', 'create_id');
   }

   //Categories Relations
   public function updatedBy(){
      return $this->hasOne(User::class, 'id', 'update_id');
   }

   //Team Media Relations
   public function teamMedia(){
      return $this->hasOne(CcTeamMedia::class, 'team_id', 'id');
   }
}
