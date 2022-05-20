<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->streetName(),
            'created_at' => $this->faker->dateTime(),
        ];
        // Schema::create('departamentos', function (Blueprint $table) {
        //     $table->id('id_departamento');
        //     $table->string('nombre');

        //     $table->integer('jefe_departamento')->nullable();
        //     $table->foreign('jefe_departamento')->references('id')->on('users');

        //     $table->dateTime('deleted_at')->nullable();
        //     $table->timestamps();
        // });
    }
}
