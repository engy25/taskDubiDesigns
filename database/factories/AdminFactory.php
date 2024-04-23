<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{User};
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\{Permission,Role};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AdminFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  protected $model = User::class;
  public function definition()
  {
    $adminRole = Role::where('name', 'Admin')->first();

    return [
      'fname' => $this->faker->firstName,
      'lname' => $this->faker->lastName,
      'phone' => $this->faker->phoneNumber,

      'is_active' => 1,
      'email' => $this->faker->unique()->safeEmail,

      'password' => "Admin250@7admin", // default password
      'role_id' => $adminRole->id,
      'remember_token' => Str::random(10),
    ];





  }
}
