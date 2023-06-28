<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\Tag;
use Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // Permission
        // ########################
        Permission::create(['name' => 'shwenagaadmin-permission']);
        Permission::create(['name' => 'shopowner-permission']);
        Permission::create(['name' => 'sdr-permission']);


        // // Role
        // // ########################
        $row1 = Role::create(['name' => 'admin']);
        $row1->givePermissionTo('shwenagaadmin-permission');

        $row2 = Role::create(['name' => 'shop-owner']);
        $row2->givePermissionTo('shopowner-permission');

        $row3 = Role::create(['name' => 'sales-development-representative']);
        $row3->givePermissionTo('sdr-permission');


        // User
        // ########################
        // User Admin
        $users = Config::get('shwe-naga.magic-login');
        foreach($users as $user){
            User::factory()->create($user)->assignRole($row1);
        }
        
        // // User None
        $users = User::factory(10)->create();
        // // User Staff SRD
        $users = User::factory(10)->create();
        foreach($users as $user){$user->assignRole($row2);}
        // // User Shop Owner
        $users = User::factory(10)->create();
        foreach($users as $user){$user->assignRole($row3);}
        // // User Admin
        $users = User::factory(10)->create();
        foreach($users as $user){$user->assignRole($row1);}


        // Tag
        // ########################
        Tag::factory()->create(['name' => 'ဓါတ်မြေသြဇာ',]);
        Tag::factory()->create(['name' => 'မှိုသတ်ဆေး',]);
        Tag::factory()->create(['name' => 'ပေါင်းသတ်ဆေး',]);
        Tag::factory()->create(['name' => 'ပိုးသတ်ဆေး',]);
        // Tag::factory(20)->create();


        // Product
        // ########################
        // \App\Models\Product::factory(100)->create();
        \App\Models\Product::factory(50)->create();
    }
}
