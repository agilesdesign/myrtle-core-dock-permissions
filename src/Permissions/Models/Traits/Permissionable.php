<?php

namespace Myrtle\Core\Permissions\Models\Traits;


use Myrtle\Core\Permissions\Models\Ability;
use App\Models\Permission;

trait Permissionable
{
    public function permissions()
    {
        return $this->morphToMany(Ability::class, 'permissionable', 'permissions');
    }
}