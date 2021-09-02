<?php

namespace Tests\Feature;

use App\Models\Imovel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImovelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function deve_retornar_uma_lista_de_imoveis()
    {
        $this->getJson(route('imoveis.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data',
                'links'
            ]);
    }

    public function camposObrigatoriosProvider()
    {
        return [
            [
                ['email_proprietario' => '']
            ],
            [
                ['cep' => '']
            ],
            [
                ['rua' => '']
            ],
            [
                ['bairro' => '']
            ],
            [
                ['cidade' => '']
            ]
        ];
    }

    /**
     * @test
     * @dataProvider camposObrigatoriosProvider
     */
    public function deve_retornar_erros_de_campos_obrigatorios($data)
    {
        $imovel = Imovel::factory()->make($data);

        $this->postJson(route('imoveis.store'), $imovel->toArray())
            ->assertJsonValidationErrors(array_keys($data));
    }

    /**
     * @test
     */
    public function deve_retornar_erro_de_cep_invalido()
    {
        $imovel = Imovel::factory()->make(['cep' => '123']);

        $this->postJson(route('imoveis.store'), $imovel->toArray())
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['cep']);
    }

    /**
     * @test
     */
    public function deve_cadastrar_imovel_com_sucesso()
    {
        $imovel = Imovel::factory()->make([
            'cep' => '35042290'
        ]);

        $this->postJson(route('imoveis.store'), $imovel->toArray())
            ->assertCreated()
            ->assertJsonStructure(['data']);

        $this->assertDatabaseCount('imoveis', 1);
        $this->assertDatabaseHas('imoveis', [
            'email_proprietario' => $imovel->email_proprietario
        ]);
    }

    /**
     * @test
     */
    public function testa_soft_delete()
    {
        $imovel = Imovel::factory()->create([
            'cep' => '35042290'
        ]);

        $this->deleteJson(route('imoveis.destroy', $imovel->id))
            ->assertOk();

        $this->assertDatabaseCount('imoveis', 1);
        $this->assertDatabaseHas('imoveis', [
            'email_proprietario' => $imovel->email_proprietario,
        ]);
        $imovel->refresh();
        $this->assertNotEmpty($imovel->deleted_at);
    }
}
