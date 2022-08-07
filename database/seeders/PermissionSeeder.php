<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            ['name' => 'user.view'],
            ['name' => 'user.add'],
            ['name' => 'user.edit'],
            ['name' => 'user.delete'],

            ['name' => 'role.view'],
            ['name' => 'role.add'],
            ['name' => 'role.edit'],
            ['name' => 'role.delete'],

            // ['name' => 'sale.view'],
            // ['name' => 'sale.add'],
            // ['name' => 'sale.edit'],
            // ['name' => 'sale.delete'],
        ];

        $insert_permission = [];
        $time_stamp = date('Y-m-d H:i:s');
        foreach ($permission as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_permission[] = $d;
        }
        Permission::insert($insert_permission);

        $admin_role = Role::create([
            'name' => 'Super Admin'
        ]);

        $normal_user_role = Role::create([
            'name' => 'Normal User'
        ]);

        $normal_user_role->syncPermissions($permission);

        $users = User::all();

        foreach ($users as $user) {
            if ($user->email == "admin@pirmam.com") {
                $user->assignRole($admin_role->name);
            } else {
                $user->assignRole($normal_user_role->name);
            }
        }

    }
}
