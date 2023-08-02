<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

class OrchidPermissionsServiceProvider extends ServiceProvider
{
    public function boot(Dashboard $dashboard)
    {
        foreach ($this->getPermissions() as $permission) {
            $dashboard->registerPermissions($permission);
        }
    }

    /**
     * Получение всех пермишенов из конфиг файла
     *
     * @return array
     */
    private function getPermissions(): array
    {
        $permissions = [];
        foreach (config('orchid-permissions.platform.sections') as $sectionName => $sectionData) {
            $group = ItemPermission::group($sectionData['name']);
            foreach ($sectionData['permissions'] as $permissionKey => $permissionName) {
                $group = $group->addPermission("$sectionName.$permissionKey", $permissionName);
            }
            $permissions[] = $group;
        }

//        foreach (config('orchid-permissions') as $permissionKey => $permission) {
//            $group = ItemPermission::group($permission['name']);
//            foreach ($permission['permissions'] as $key => $item) {
//                $group = $group->addPermission("$permissionKey.$key", $item);
//            }
//            $permissions[] = $group;
//        }
//
        return $permissions;
    }
}
