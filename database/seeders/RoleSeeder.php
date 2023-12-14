<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCliente = Role::create(['name' => 'cliente']);

        Permission::create(['name' => 'admin.home'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.pedidos'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.crear.producto'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.producto.edit'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.producto.update'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.producto.delete'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.producto.store'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.productos.hamburgesas'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.productos.bebidas'])->assignRole($roleAdmin);
        Permission::create(['name' => 'admin.usuarios'])->assignRole($roleAdmin);

    }
}
