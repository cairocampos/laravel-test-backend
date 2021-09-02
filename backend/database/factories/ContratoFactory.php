<?php

namespace Database\Factories;

use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipo_pessoa = array_rand([
            Contrato::TIPO_PESSOA_FISICA,
            Contrato::TIPO_PESSOA_JURIDICA
        ]);

        $documento = $tipo_pessoa == Contrato::TIPO_PESSOA_FISICA ? $this->faker->cpf : $this->faker->cnpj;

        return [
            'imovel_id'         => Imovel::factory(),
            'email_contratante' => $this->faker->email(),
            'nome_contratante'  => $this->faker->name(),
            'tipo_pessoa'       => $tipo_pessoa,
            'cpf_cnpj'          => $documento
        ];
    }
}
