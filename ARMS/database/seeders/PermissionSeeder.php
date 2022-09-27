<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        $permissions = [
            'animal-type-list',
            'animal-type-create',
            'animal-type-edit',
            'animal-type-delete',

            'animal-list',
            'animal-create',
            'animal-edit',
            'animal-delete',

            'bincard-list',
            'bincard-create',
            'bincard-edit',
            'bincard-delete',

            'gender-list',
            'gender-create',
            'gender-edit',
            'gender-delete',

            'healthy-history-list',
            'healthy-history-create',
            'healthy-history-edit',
            'healthy-history-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',

            'sale-list',
            'sale-create',
            'sale-edit',
            'sale-delete',

            'staff-member-list',
            'staff-member-create',
            'staff-member-edit',
            'staff-member-delete',

            'stock-list',
            'stock-create',
            'stock-edit',
            'stock-delete',

            'unit-list',
            'unit-create',
            'unit-edit',
            'unit-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'vet-doctor-list',
            'vet-doctor-create',
            'vet-doctor-edit',
            'vet-doctor-delete'
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
