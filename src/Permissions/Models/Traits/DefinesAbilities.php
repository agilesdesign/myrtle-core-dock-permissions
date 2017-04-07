<?php

namespace Myrtle\Core\Permissions\Models\Traits;

use Illuminate\Support\Arr;
use Myrtle\Core\Permissions\Models\Ability;

trait DefinesAbilities
{
    protected function getAbilityIdentifierAttribute()
    {
        return $this->{$this->primaryKey};
    }

    protected function getAbilitiesAttribute()
    {
        return Ability::whereIn('name', $this->buildAbilitiesDictionary()->keys())->get();
    }

    protected function buildAbilitiesDictionary()
    {
        return collect(Arr::dot(config('abilities.' . static::class, []), static::class . '.' . $this->resolveAbilityIdentifier()));
    }

    protected function resolveAbilityIdentifier()
    {
        return $this->abilityIdentifier ? $this->abilityIdentifier . '.' : '';
    }

    public function populateAbilityTable()
    {
        $this->buildAbilitiesDictionary()->each(function($description, $name) {
            Ability::updateOrCreate(['name' => $name]);
        });
    }
}