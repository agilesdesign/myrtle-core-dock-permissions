<?php

namespace Myrtle\Core\Docks;

use Myrtle\Permissions\Providers\PermissionsServiceProvider;

class PermissionsDock extends Dock
{
    /**
     * Description for Dock
     *
     * @var string
     */
    public $description = 'Permissions manager';

    /**
     * List of config file paths to be loaded
     *
     * @return array
     */
    public function configPaths()
    {
        return [
            'docks.' . self::class => dirname(__DIR__, 3) . '/config/docks/permissions.php',
            'abilities' => dirname(__DIR__, 3) . '/config/abilities.php',
        ];
    }

    /**
     * List of migration file paths to be loaded
     *
     * @return array
     */
    public function migrationPaths()
    {
        return [
            dirname(__DIR__, 3) . '/database/migrations',
        ];
    }

    /**
     * List of providers to be registered
     *
     * @var array
     */
    public $providers = [
        PermissionsServiceProvider::class
    ];
}
