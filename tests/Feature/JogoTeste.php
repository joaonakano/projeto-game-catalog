<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JogoTeste extends TestCase
{
    use RefreshDatabase;

    protected $usuario;
    protected $dadosJogo;
    protected $dadosJogo2;

    protected function setUp(): void
    {
        parent::setUp();

        // Criar usuário e logar
        $this->usuario = User::factory()->create([
            'email' => 'joao@gmail.com',
            'password' => bcrypt('Joao1234!'),
        ]);
        $this->actingAs($this->usuario);

        Storage::fake('public');

        $this->dadosJogo = [
            'name' => 'Zelda: Breath of the Wild',
            'description' => 'Explore o vasto mundo aberto de Hyrule e desvende os mistérios nele.',
            'release_date' => '2017-03-03',
            'developer' => 'Nintendo',
            'publisher' => 'Nintendo',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];

        $this->dadosJogo2 = [
            'name' => 'Stardew Valley',
            'description' => 'Um jogo de simulação de fazenda com muitos elementos de RPG.',
            'release_date' => '2016-02-26',
            'developer' => 'ConcernedApe',
            'publisher' => 'Chucklefish',
            'logo' => UploadedFile::fake()->image('logo2.jpg'),
        ];
    }

    // Cadastro

    public function test_nao_deve_cadastrar_jogo_com_campos_vazios()
    {
        $response = $this->post('/games/register', [
            'name' => '    ',
            'description' => '    ',
            'release_date' => '2022-02-23',
            'developer' => '    ',
            'publisher' => '    ',
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ]);

        $response->assertSessionHasErrors(['name', 'description', 'developer', 'publisher']);
    }

    public function test_nao_deve_cadastrar_jogo_com_nome_somente_numeros()
    {
        $dados = $this->dadosJogo;
        $dados['name'] = '1234';

        $response = $this->post('/games/register', $dados);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_nao_deve_cadastrar_jogo_com_nome_somente_simbolos()
    {
        $dados = $this->dadosJogo;
        $dados['name'] = '!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$$%^*())))))----====++++/;;;;..,,,';

        $response = $this->post('/games/register', $dados);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_nao_deve_cadastrar_jogo_com_nome_e_campos_muito_grandes()
    {
        $dados = [
            'name' => str_repeat('oi', 500),
            'description' => str_repeat('descricao', 100),
            'release_date' => $this->dadosJogo['release_date'],
            'developer' => str_repeat('tchau', 100),
            'publisher' => str_repeat('skibidi', 100),
            'logo' => UploadedFile::fake()->image('logo.jpg'),
        ];

        $response = $this->post('/games/register', $dados);

        $response->assertSessionHasErrors(['name', 'description', 'developer', 'publisher']);
    }

    public function test_nao_deve_cadastrar_jogo_com_data_de_lancamento_invalida()
    {
        $dados = $this->dadosJogo;
        $dados['release_date'] = '1500-01-07';

        $response = $this->post('/games/register', $dados);

        $response->assertSessionHasErrors(['release_date']);
    }

    public function test_nao_deve_cadastrar_jogo_com_logo_em_formato_invalido()
    {
        $dados = $this->dadosJogo;
        $dados['logo'] = UploadedFile::fake()->create('rick.gif', 100, 'image/gif');

        $response = $this->post('/games/register', $dados);

        $response->assertSessionHasErrors(['logo']);
    }

    public function test_deve_cadastrar_jogo_com_sucesso()
    {
        $response = $this->post('/games/register', $this->dadosJogo);
        $response->assertRedirect('/games');

        $this->assertDatabaseHas('games', [
            'name' => $this->dadosJogo['name'],
            'description' => $this->dadosJogo['description'],
        ]);

        Storage::disk('public')->assertExists('logos/' . $this->dadosJogo['logo']->hashName());

        // Cadastrar segundo jogo
        $response2 = $this->post('/games/register', $this->dadosJogo2);
        $response2->assertRedirect('/games');

        $this->assertDatabaseHas('games', ['name' => $this->dadosJogo2['name']]);
    }

    // Edição

    public function test_deve_permitir_editar_jogo_sem_alterar_informacoes()
    {
        $jogo = Game::factory()->create(['user_id' => $this->usuario->id]);

        $response = $this->put("/games/{$jogo->id}", $jogo->toArray());

        $response->assertRedirect('/games');
    }

    public function test_nao_deve_permitir_editar_jogo_com_nome_ja_existente()
    {
        $jogo1 = Game::factory()->create(['name' => $this->dadosJogo['name'], 'user_id' => $this->usuario->id]);
        $jogo2 = Game::factory()->create(['user_id' => $this->usuario->id]);

        $dados = $jogo2->toArray();
        $dados['name'] = $jogo1->name;
        $dados['logo'] = UploadedFile::fake()->image('logo.jpg');

        $response = $this->put("/games/{$jogo2->id}", $dados);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_deve_editar_jogo_com_sucesso()
    {
        $jogo = Game::factory()->create(['user_id' => $this->usuario->id]);

        $dados = [
            'name' => 'Jogo Editado',
            'description' => 'Teste de Edição de Jogo',
            'release_date' => $jogo->release_date,
            'developer' => 'Desenvolvedora Editado',
            'publisher' => 'Distribuidora Editado',
            'logo' => UploadedFile::fake()->image('logo_edit.jpg'),
        ];

        $response = $this->put("/games/{$jogo->id}", $dados);

        $response->assertRedirect('/games');
        $this->assertDatabaseHas('games', ['name' => 'Jogo Editado']);
    }

    // Exclusão

    public function test_deve_remover_jogo_existente()
    {
        $jogo = Game::factory()->create(['user_id' => $this->usuario->id]);

        $response = $this->delete("/games/{$jogo->id}");

        $response->assertRedirect('/games');
        $this->assertDatabaseMissing('games', ['id' => $jogo->id]);
    }
}
