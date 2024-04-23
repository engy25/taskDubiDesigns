<?php

namespace Database\Factories;
use App\Models\{User, Role};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;
    public function definition()
    {
      $userRoleId = Role::where('name', 'User')->first()->id;

      return [
        'fname' => $this->faker->firstName,
        'lname' => $this->faker->lastName,
        'phone' => $this->faker->phoneNumber,

        'is_active' => 1,
        'email' => $this->faker->unique()->safeEmail,

        'password' => "User250@7user", 
        'role_id' => $userRoleId,
        'remember_token' => Str::random(10),
      ];
    }
  }
