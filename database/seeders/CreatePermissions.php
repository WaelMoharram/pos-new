<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class createPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'index users']);
        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'index sales_men']);
        Permission::create(['name' => 'add sales_men']);
        Permission::create(['name' => 'edit sales_men']);
        Permission::create(['name' => 'delete sales_men']);

        Permission::create(['name' => 'index stores']);
        Permission::create(['name' => 'add stores']);
        Permission::create(['name' => 'edit stores']);
        Permission::create(['name' => 'delete stores']);

        Permission::create(['name' => 'index transfer']);
        Permission::create(['name' => 'add transfer']);
        Permission::create(['name' => 'edit transfer']);
        Permission::create(['name' => 'delete transfer']);

        Permission::create(['name' => 'index categories']);
        Permission::create(['name' => 'add categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'index brands']);
        Permission::create(['name' => 'add brands']);
        Permission::create(['name' => 'edit brands']);
        Permission::create(['name' => 'delete brands']);

        Permission::create(['name' => 'index options']);
        Permission::create(['name' => 'add options']);
        Permission::create(['name' => 'edit options']);
        Permission::create(['name' => 'delete options']);

        Permission::create(['name' => 'index items']);
        Permission::create(['name' => 'add items']);
        Permission::create(['name' => 'edit items']);
        Permission::create(['name' => 'delete items']);

        Permission::create(['name' => 'index sales']);
        Permission::create(['name' => 'add sales']);
        Permission::create(['name' => 'edit sales']);
        Permission::create(['name' => 'delete sales']);

        Permission::create(['name' => 'index sales-return']);
        Permission::create(['name' => 'add sales-return']);
        Permission::create(['name' => 'edit sales-return']);
        Permission::create(['name' => 'delete sales-return']);

        Permission::create(['name' => 'index client']);
        Permission::create(['name' => 'add client']);
        Permission::create(['name' => 'edit client']);
        Permission::create(['name' => 'delete client']);

        Permission::create(['name' => 'index purchases']);
        Permission::create(['name' => 'add purchases']);
        Permission::create(['name' => 'edit purchases']);
        Permission::create(['name' => 'delete purchases']);

        Permission::create(['name' => 'index purchases-return']);
        Permission::create(['name' => 'add purchases-return']);
        Permission::create(['name' => 'edit purchases-return']);
        Permission::create(['name' => 'delete purchases-return']);

        Permission::create(['name' => 'index suppliers']);
        Permission::create(['name' => 'add suppliers']);
        Permission::create(['name' => 'edit suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'index payments']);
        Permission::create(['name' => 'add payments']);
        Permission::create(['name' => 'edit payments']);
        Permission::create(['name' => 'delete payments']);


        Permission::create(['name' => 'delete settings']);
    }
}
