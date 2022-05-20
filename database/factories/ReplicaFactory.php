<?php

namespace Database\Factories;

use App\Models\Objeto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo_qr' => $this->faker->unique()->sha1(),
            'objeto' => Objeto::inRandomOrder()->first()->id,
            'created_at' => $this->faker->dateTime(),
            'incidencias' => $this->faker->text(25),
        ];
        // Schema::create('replicas', function (Blueprint $table) {
        //     $table->id('id_replica');
        //     $table->string('codigo_qr')->unique();
        //     $table->string('incidencias')->nullable();

        //     $table->integer('objeto');
        //     $table->foreign('objeto')->references('id')->on('objetos');

        //     $table->dateTime('deleted_at')->nullable();
        //     $table->timestamps();
        // });
    }
}
