<?php

namespace Database\Factories;

use App\Models\Departamento;
use Illuminate\Database\Eloquent\Factories\Factory;

class AulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->text(5),
            'piso' => $this->faker->numberBetween(0, 2),
            'numero' => $this->faker->numberBetween(0, 25),
            'id_departamento' => Departamento::inRandomOrder()->first()->id_departamento,
            'created_at' => $this->faker->dateTime(),
        ];
        // Schema::create('aulas', function (Blueprint $table) {
        //     $table->id('id_aula');
        //     $table->integer('piso');
        //     $table->integer('numero');

        //     $table->integer('id_departamento');
        //     $table->foreign('id_departamento')->references('id_departamento')->on('departamentos');

        //     $table->dateTime('deleted_at')->nullable();
        //     $table->timestamps();
        // });
    }
}
