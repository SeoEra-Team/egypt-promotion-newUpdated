<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Dynamically add the permissions
     * based on policies inside app/Policies folder
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([]);

        $path = 'app/Policies';

        $allFiles = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $phpFiles = new RegexIterator($allFiles, '/\.php$/');
        foreach ($phpFiles as $phpFile) {
            if($phpFile->getFileName() != 'CorePolicy.php')
                $collection->add(strtolower(substr($phpFile->getFileName(), 0, -10)));
        }
        $collection->each(function($item, $key) {
            Permission::findOrCreate('viewAny ' . $item,'administrator');
            Permission::findOrCreate('view ' . $item, 'administrator');
            Permission::findOrCreate('update ' . $item, 'administrator');
            Permission::findOrCreate('create ' . $item,  'administrator');
            Permission::findOrCreate('delete ' . $item, 'administrator');
            Permission::findOrCreate('restore ' . $item, 'administrator');
            Permission::findOrCreate('forceDelete ' . $item, 'administrator');
        });

        Permission::findOrCreate('access dashboard', 'administrator');
        Permission::findOrCreate('edit settings', 'administrator');
        Permission::findOrCreate('edit translations', 'administrator');
        Permission::findOrCreate('manage languages', 'administrator');
        Permission::findOrCreate('manage media', 'administrator');
        Permission::findOrCreate('update slug', 'administrator');

        $role = Role::findOrCreate('Super Administrator', 'administrator');
        $role->givePermissionTo(Permission::all());
    }
}
