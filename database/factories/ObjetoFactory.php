<?php

namespace Database\Factories;

use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObjetoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->text(20),
            'descripcion' => $this->faker->text(400),
            'id_aula' => Aula::inRandomOrder()->first()->id_aula,
            'created_at' => $this->faker->dateTime(),
        ];
        // Schema::create('objetos', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nombre');
        //     $table->text('descripcion');

        //     $table->integer('id_aula');
        //     $table->foreign('id_aula')->references('id_aula')->on('aulas');

        //     $table->dateTime('deleted_at')->nullable();
        //     $table->timestamps();
        // });
    }
}
