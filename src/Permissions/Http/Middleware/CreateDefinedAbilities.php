<?php

namespace Myrtle\Core\Permissions\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Myrtle\Permissions\Models\Ability;
use Myrtle\Permissions\Models\Traits\DefinesAbilities;

class CreateDefinedAbilities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Route::is('*.permissions.edit') && Schema::hasTable('abilities'))
        {
            $parameters = $request->route()->parameters();

            collect($parameters)->reject(function($parameter, $key) {
                return ! is_object($parameter);
            })->filter(function($object, $key) {
                return collect(array_merge([get_class($object)], class_parents($object)))->filter(function($class, $key) {
                    return ! in_array(DefinesAbilities::class, class_uses($class));
                });
            })->each(function($object) {
                $object->populateAbilityTable();
            });
        }

        return $next($request);
    }
}
