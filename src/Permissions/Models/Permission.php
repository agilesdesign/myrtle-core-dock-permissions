<?php

namespace Myrtle\Core\Permissions\Models;

use Illuminate\Database\Eloquent\Model;
use Myrtle\Roles\Models\Role;
use Myrtle\Users\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	use SoftDeletes;

    protected $fillable = ['ability_id', 'abilityable_id', 'abilityables_type'];

    public function ability()
    {
        return $this->belongsTo(Ability::class);
    }

    public function roles()
	{
		return $this->morphMany(Role::class, 'permissionable');
	}

	public function users()
	{
		return $this->morphMany(User::class, 'permissionable');
	}
}
