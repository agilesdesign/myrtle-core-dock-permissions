<?php

namespace Myrtle\Core\Permissions\Models;

use Myrtle\Roles\Models\Role;
use Myrtle\Users\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ability extends Model
{
	use SoftDeletes;

    protected $fillable = ['name'];

    public $timestamps = false;

	public function roles()
	{
		return $this->morphToMany(Role::class, 'permissionable', 'permissions', 'ability_id', 'permissionable_id', true);
	}

	public function users()
	{
		return $this->morphToMany(User::class, 'permissionable', 'permissions', 'ability_id', 'permissionable_id', true);
	}
}
