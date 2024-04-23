<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Database\Factories\AdminFactory;
use Spatie\Permission\Models\{Permission};

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $admins = AdminFactory::new()->count(100)->create();

    /**
     * the permissions of the admins
     */
    $permissionRole = Permission::findByName('view roles');
    $permissionPermission = Permission::findByName('view permissions');
    $permissionTask = Permission::findByName('view tasks');
    $permissionUser = Permission::findByName('view users');
    $permissionStatistic = Permission::findByName('view statistics');
    $permissionCreteTask = Permission::findByName('create Task');
   


    // Assign permissions to each admin
    foreach ($admins as $admin) {
      $admin->givePermissionTo($permissionRole);
      $admin->givePermissionTo($permissionPermission);
      $admin->givePermissionTo($permissionTask);
      $admin->givePermissionTo($permissionUser);
      $admin->givePermissionTo($permissionStatistic);
      $admin->givePermissionTo($permissionCreteTask);
      $admin->assignRole("Admin");
    }

  }
}
