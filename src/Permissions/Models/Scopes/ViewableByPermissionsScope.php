<?php

namespace Myrtle\Core\Permissions\Models\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ViewableByPermissionsScope implements Scope {

	public function apply(Builder $builder, Model $model)
	{
		if (Gate::denies('view', $model))
		{
			$builder->whereIn('id', $this->getViewableIds($model)->toArray());
		}
	}

	protected function getViewableIds(Model $model)
	{
		$abilityNameMask = $model->getViewableAbilityName();

		return Auth::user()->allPermissions->pluck('name')->reject(function ($ability, $key) use ($abilityNameMask)
		{
			return ! Str::is($abilityNameMask, $ability);
		})->map(function ($ability, $key) use ($abilityNameMask)
		{
			return $this->getIdFromAbilityName($ability, $abilityNameMask);
		})->reject(function ($result, $key)
		{
			return ! (boolean)intval($result);
		});
	}

	protected function getIdFromAbilityName(string $name, string $mask)
	{
		return collect(explode('*', $mask))->reduce(function($carry, $item) {
			return Str::replaceFirst($item, '', $carry);
		}, $name);
	}

}
