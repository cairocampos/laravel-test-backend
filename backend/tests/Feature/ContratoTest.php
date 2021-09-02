<?php

namespace Tests\Feature;

use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContratoTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp():void
    {
        parent::setUp();
        $this->faker('pt_BR');
    }

    /**
     * @test
     */
    public function deve_criar_um_contrato_associado_a_um_imovel()
    {
        $imovel = Imovel::factory()->create(['cep' => '35042290']);

        $contrato = Contrato::factory()->make([
            'imovel_id' => $imovel->id,
            'tipo_pessoa' => 'pf',
            'cpf_cnpj' => $this->faker->cpf
        ]);

        $response = $this->postJson(route('contratos.store'), $contrato->toArray());
        $response->assertCreated();

        $payload = $response->json();

        $this->assertDatabaseHas('contratos', [
            'id' => $payload['data']['id']
        ]);
    }

    public function providerDocumentoInvalido()
    {
        return [
            [
                [
                    'tipo_pessoa' => 'pf',
                    'cpf_cnpj' => '12345'
                ],
                [
                    'tipo_pessoa' => 'pj',
                    'cpf_cnpj' => '12345'
                ]
            ]
        ];
    }

    /**
     * @test
     * @dataProvider providerDocumentoInvalido
     */
    public function deve_retornar_erro_de_documento_invalido($data)
    {
        $imovel = Imovel::factory()->create(['cep' => '35042290']);

        $contrato = Contrato::factory()->make(array_merge($data,[
            'imovel_id' => $imovel->id
        ]));

        $this->postJson(route('contratos.store'), $contrato->toArray())
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'cpf_cnpj'
            ]);
    }

    /**
     * @test
     */
    public function deve_retornar_erro_ao_tentar_associar_um_imovel_com_multiplos_contratos()
    {
        $imovel = Imovel::factory()->create(['cep' => '35042290']);

        Contrato::factory()->create([
            'imovel_id' => $imovel->id,
            'tipo_pessoa' => 'pf',
            'cpf_cnpj' => $this->faker->cpf
        ]);

        $novoContrato = Contrato::factory()->make([
            'imovel_id' => $imovel->id,
            'email_contratante' => $this->faker->email(),
            'tipo_pessoa' => 'pf',
            'cpf_cnpj' => $this->faker->cpf
        ]);

        $this->postJson(route('contratos.store'), $novoContrato->toArray())
            ->assertUnprocessable();

        $this->assertDatabaseCount('contratos', 1);
    }
}
