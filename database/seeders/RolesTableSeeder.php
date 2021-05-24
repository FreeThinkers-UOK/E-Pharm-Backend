<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ],

            [
                'name'        => 'StoreKeeper',
                'slug'        => 'storekeeper',
                'description' => 'StoreKeeper Role',
                'level'       => 1,
            ],
            [
                'name'        => 'Cashier',
                'slug'        => 'cashier',
                'description' => 'Cashier Role',
                'level'       => 1,
            ],
            [
                'name'        => 'Pharmacist',
                'slug'        => 'pharmacist',
                'description' => 'Pharmacist Role',
                'level'       => 1,
            ],
            [
                'name'        => 'AssistantPharmacist',
                'slug'        => 'assistantpharmacist',
                'description' => 'AssistantPharmacist Role',
                'level'       => 1,
            ],
            [
                'name'        => 'DeliveryMen',
                'slug'        => 'deliverymen',
                'description' => 'DeliveryMen Role',
                'level'       => 1,
            ],

        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
