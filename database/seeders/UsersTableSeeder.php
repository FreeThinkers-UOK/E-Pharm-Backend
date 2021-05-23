<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = config('roles.models.role')::where('name', '=', 'User')->first();
        $adminRole = config('roles.models.role')::where('name', '=', 'Admin')->first();
        $pharmacistRole = config('roles.models.role')::where('name', '=', 'Pharmacist')->first();
        $assistantpharmacistRole = config('roles.models.role')::where('name', '=', 'AssistantPharmacist')->first();
        $cashierRole = config('roles.models.role')::where('name', '=', 'Cashier')->first();
        $deliverymenRole = config('roles.models.role')::where('name', '=', 'DeliveryMen')->first();
        $storekeeperRole = config('roles.models.role')::where('name', '=', 'StoreKeeper')->first();
        $permissions = config('roles.models.permission')::all();

        /*
         * Add Users
         *
         */
        if (config('roles.models.defaultUser')::where('email', '=', 'admin@admin.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Admin',
                'first_name'=>'pharm',
                'last_name'=>'pharm',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('password'),
            ]);

            $newUser->attachRole($adminRole);
            foreach ($permissions as $permission) {
                $newUser->attachPermission($permission);
            }
        }

        if (config('roles.models.defaultUser')::where('email', '=', 'pharmacist@epharm.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Pharmacist',
                'first_name'=>'mpharm',
                'last_name'=>'mpharm',
                'email'    => 'pharmacist@epharm.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($pharmacistRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'aspharmacist@epharm.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'ASPharmacist',
                'first_name'=>'aspharm',
                'last_name'=>'aspharm',
                'email'    => 'aspharmacist@epharm.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($assistantpharmacistRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'cashier@epharm.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Cashier',
                'first_name'=>'cashier',
                'last_name'=>'cashier',
                'email'    => 'cashier@epharm.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($cashierRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'deliverymen@epharm.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'Deliverymen',
                'first_name'=>'deliverymen',
                'last_name'=>'deliverymen',
                'email'    => 'deliverymen@epharm.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($deliverymenRole);
        }
        if (config('roles.models.defaultUser')::where('email', '=', 'storekeeper@epharm.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'name'     => 'StoreKeeper',
                'first_name'=>'storekeeper',
                'last_name'=>'storekeeper',
                'email'    => 'storekeeper@epharm.com',
                'password' => bcrypt('password'),
            ]);

            $newUser;
            $newUser->attachRole($storekeeperRole);
        }
    }
}
