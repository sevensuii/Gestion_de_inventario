<?php

namespace Database\Factories;

use App\Models\Departamento;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'apellidos' => $this->faker->lastName(),
            'dni' => $this->faker->unique()->dni(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('changeme'), // changeme
            'remember_token' => Str::random(10),
            'fecha_nacimiento' => $this->faker->date(),
            'first_loggin' => $this->faker->dateTime(),
            'created_at' => $this->faker->dateTime(),
            // 'profile_photo_path' => $this->faker->imageUrl(),
            'trabaja_departamento' => Departamento::inRandomOrder()->first()->id_departamento,
        ];
    }
/*
Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellidos')->nullable();
            $table->string('dni')->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->date('fecha_nacimiento');
            $table->datetime('first_loggin')->nullable();
            $table->datetime('deleted_at')->nullable();
            $table->timestamps();
        });
*/
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }
}
