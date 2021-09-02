<?php

namespace Database\Factories;

use App\Models\Imovel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImovelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Imovel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email_proprietario' => $this->faker->email(),
            'cep' => $this->faker->postcode(),
            'rua' => $this->faker->address(),
            'bairro' => $this->faker->address(),
            'numero' => (string) $this->faker->numberBetween(1),
            'complemento' => '',
            'cidade' => $this->faker->city(),
            'estado' => $this->faker->randomElement(['MG','SP','DF','RJ']),
            'cor' => '',
            'total_divisoes' => $this->faker->numberBetween(1,10)
        ];
    }
}
