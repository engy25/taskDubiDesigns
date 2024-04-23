<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use App\Models\User;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    // Admin role and permissions
    $adminRole = Role::where('name', 'Admin')->first();

    $permissionsAdmin = [
      'view roles',
      'view permissions',
      'view tasks',
      'view users',
      'view statistics',
      'create Task'
    ];

    foreach ($permissionsAdmin as $permissionName) {
      $permission = Permission::create([
        'name' => $permissionName,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      $adminRole->givePermissionTo($permission);
    }

    // User role and permissions
    $userRole = Role::where('name', 'User')->first();

    $permissionsUser = [
      'view userTasks',
    ];

    foreach ($permissionsUser as $permissionName) {
      $permission = Permission::create([
        'name' => $permissionName,
        'guard_name' => 'web',
        'created_at' => now(),
        'updated_at' => now(),
      ]);
      $userRole->givePermissionTo($permission);
    }
  }
}
