<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desarrollador = Role::create(['name' => 'desarrollador']);
        $administrativos = Role::create(['name' => 'administrativos']);
        $prestatarios = Role::create(['name' => 'prestatarios']);

        Permission::create(['name' => 'admin.roles.index', 'description' => 'Ver Index Roles'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Create Roles'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Edit Roles'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Delete Roles'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.roles.update', 'description' => 'Update Roles'])->syncRoles([$desarrollador]);

        Permission::create(['name' => 'admin.user.index', 'description' => 'Ver Index Users'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.user.create', 'description' => 'Create Users'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.user.edit', 'description' => 'Edit Users'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.user.destroy', 'description' => 'Delete Users'])->syncRoles([$desarrollador]);
        Permission::create(['name' => 'admin.user.update', 'description' => 'Update Users'])->syncRoles([$desarrollador]);

        Permission::create(['name' => 'admin.gesbook.index', 'description' => 'Ver Index Libros'])->syncRoles([$administrativos]);

        Permission::create(['name' => 'admin.gesprestamo.index', 'description' => 'Ver Index Prestamos'])->syncRoles([$administrativos,$prestatarios]);
        
    }
}
