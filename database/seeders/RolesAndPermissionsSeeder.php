<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $staff = Role::updateOrCreate(['name' => 'Staff']);
        $broker = Role::updateOrCreate(['name' => 'Broker']);
        $admin = Role::updateOrCreate(['name' => 'Admin']);
        $superAdmin = Role::updateOrCreate(['name' => 'Super Admin']);
        $client = Role::updateOrCreate(['name' => 'Client']);

        $userStaff = User::updateOrCreate(
                        [
                            'name' => 'Staff',
                            'email' => 'staff@staff.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        
        $userBroker = User::updateOrCreate(
                        [
                            'name' => 'Broker',
                            'email' => 'broker@broker.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        $useradmin = User::updateOrCreate(
                        [
                            'name' => 'admin',
                            'email' => 'admin@admin.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        $userSuperAdmin = User::updateOrCreate(
                        [
                            'name' => 'superadmin',
                            'email' => 'superadmin@superadmin.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);
        $userClient = User::updateOrCreate(
                        [
                            'name' => 'client',
                            'email' => 'client@client.com',
                        ],
                        [
                            'password' => bcrypt('admin123')
        ]);

       
        $userStaff->assignRole($staff);
        $userBroker->assignRole($broker);
        $useradmin->assignRole($admin);
        $userSuperAdmin->assignRole($superAdmin);
        $userClient->assignRole($client);
       
    }

}
