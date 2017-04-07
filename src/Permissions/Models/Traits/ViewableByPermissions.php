<?php

namespace Myrtle\Core\Permissions\Models\Traits;


use Myrtle\Core\Permissions\Models\Scopes\ViewableByPermissionsScope;

trait ViewableByPermissions {

	public function getViewableAbilityName()
	{
		return $this->viewableAbilityName;
	}
	public static function bootViewableByPermissions()
	{
		static::addGlobalScope(new ViewableByPermissionsScope());
	}
}