<?php

namespace Myrtle\Core\Permissions\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

trait CanView
{
    public function scopeCanView(Builder $query)
    {
        return $query
            ->whereIn('id', $this->getViewableIds()->toArray())
            ->orWhereRaw('true = ' . (int) Gate::allows('view', static::class));
    }

	protected function getViewableAbilityNameAttribute()
	{
		return static::class . '.*.view';
	}

    protected function getViewableIds()
    {
        return auth()->user()->allPermissions->pluck('name')->reject(function ($ability) {
            return ! Str::is($this->viewableAbilityName, $ability);
        })->map(function ($ability) {
            return $this->getIdFromAbilityName($ability, $this->viewableAbilityName);
        })->reject(function ($result) {
            return ! (boolean) intval($result);
        });
    }

    protected function getIdFromAbilityName(string $name, string $mask)
    {
        return collect(explode('*', $mask))->reduce(function($carry, $item) {
            return Str::replaceFirst($item, '', $carry);
        }, $name);
    }
}