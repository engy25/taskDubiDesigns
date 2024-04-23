<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission};

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //
    $users = UserFactory::new()->count(1000)->create();

    /**
     * after create each user i assign the permission  view userTasks to this user
     */

    $permissionUserTask = Permission::findByName('view userTasks');
    // Assign permissions to each admin
    foreach ($users as $user) {
      $user->givePermissionTo($permissionUserTask);
      $user->assignRole("User");
    }
  }
}
