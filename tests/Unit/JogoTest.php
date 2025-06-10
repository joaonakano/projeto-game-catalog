<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class JogoTest extends TestCase
{
    use RefreshDatabase;

    protected $usuario;
    protected $dadosJogo;
    protected $dadosJogo2;

   protected function setUp(): void
{
    parent::setUp();

    // Cria usuário e autentica ele para todas as requisições
    $this->usuario = User::factory()->create([
        'email' => 'joao@gmail.com',
        'password' => bcrypt('Joao1234!'),
    ]);
    $this->be($this->usuario); // alternativa para garantir autenticação

    // Limpa a pasta de imagens antes de cada teste (cria a pasta vazia caso não exista)
    $picturesPath = public_path('pictures/games');
    if (File::exists($picturesPath)) {
        File::deleteDirectory($picturesPath);
    }
    File::makeDirectory($picturesPath, 0755, true);

    // Garante que as fixtures de imagem estejam presentes (cria cópias caso necessário)
    $fixturesDir = base_path('tests/Fixtures/images/');
    $originalPacman = $fixturesDir . 'pacman_original.jpg';
    $originalSnowWhite = $fixturesDir . 'snowWhite_original.jpg';
    $fixturePacman = $fixturesDir . 'pacman.jpg';
    $fixtureSnowWhite = $fixturesDir . 'snowWhite.jpg';
    $originalPs1 = $fixturesDir . 'ps1_original.jpg';
    $fixturePs1 = $fixturesDir . 'ps1.jpg';

    if (!file_exists($fixturePs1) && file_exists($originalPs1)) {
        copy($originalPs1, $fixturePs1);
    }
    if (!file_exists($fixturePacman) && file_exists($originalPacman)) {
        copy($originalPacman, $fixturePacman);
    }
    if (!file_exists($fixtureSnowWhite) && file_exists($originalSnowWhite)) {
        copy($originalSnowWhite, $fixtureSnowWhite);
    }

    // Dados dos jogos com as imagens carregadas
    $this->dadosJogo = [
        'name' => 'Zelda: Breath of the Wild',
        'description' => 'Explore o vasto mundo aberto de Hyrule e desvende os mistérios nele.',
        'release_date' => '2017-03-03',
        'developer' => 'Nintendo',
        'publisher' => 'Nintendo',
        'game_picture' => $this->loadFixtureImage('pacman.jpg'),
    ];

    $this->dadosJogo2 = [
        'name' => 'Stardew Valley',
        'description' => 'Um jogo de simulação de fazenda com muitos elementos de RPG.',
        'release_date' => '2016-02-26',
        'developer' => 'ConcernedApe',
        'publisher' => 'Chucklefish',
        'game_picture' => $this->loadFixtureImage('snowWhite.jpg'),
    ];
}



    /**
     * Carrega uma imagem de fixture para testes
     */
  protected function loadFixtureImage(string $filename): UploadedFile
{
    $fixturePath = base_path('tests/Fixtures/images/' . $filename);

    if (!file_exists($fixturePath)) {
        throw new \Exception("Fixture image not found: {$fixturePath}");
    }

    return new UploadedFile(
        $fixturePath,
        $filename,
        mime_content_type($fixturePath),
        null,
        true // <- aqui está o ponto crucial
    );
}


    // Cadastro

    public function test_nao_deve_cadastrar_jogo_com_campos_vazios()
    {
        $response = $this->post('/games/register', [
            'name' => '',
            'description' => '',
            'release_date' => '',
            'developer' => '',
            'publisher' => '',
            'game_picture' => null,
        ]);

        $response->assertSessionHasErrors([
            'name', 'description', 'release_date', 
            'developer', 'publisher', 'game_picture'
        ]);
    }

    public function test_nao_deve_cadastrar_jogo_com_nome_somente_numeros()
    {
        $dados = array_merge($this->dadosJogo, ['name' => '1234']);
        $response = $this->post('/games/register', $dados);
        $response->assertSessionHasErrors(['name']);
    }

    // TESTE ADICIONADO (faltava no atual)
    public function test_nao_deve_cadastrar_jogo_com_nome_somente_simbolos()
    {
        $response = $this->post('/games/register', [
            'name' => '!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$$%^*())))))----====++++/;;;;..,,,',
            'game_picture' => $this->loadFixtureImage('pacman.jpg'),
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    // TESTE ADICIONADO (faltava no atual)
    public function test_nao_deve_cadastrar_jogo_com_nome_e_campos_muito_grandes()
    {
        $response = $this->post('/games/register', [
            'name' => str_repeat('oi', 500),
            'description' => str_repeat('descricao', 100),
            'release_date' => $this->dadosJogo['release_date'],
            'developer' => str_repeat('tchau', 100),
            'publisher' => str_repeat('skibidi', 100),
            'game_picture' => $this->loadFixtureImage('pacman.jpg'),
        ]);

        $response->assertSessionHasErrors(['name', 'description', 'developer', 'publisher']);
    }

    // TESTE ADICIONADO (faltava no atual)
    public function test_nao_deve_cadastrar_jogo_com_data_de_lancamento_invalida()
    {
        $response = $this->post('/games/register', [
            'name' => $this->dadosJogo['name'],
            'description' => $this->dadosJogo['description'],
            'release_date' => '1500-01-07',
            'developer' => $this->dadosJogo['developer'],
            'publisher' => $this->dadosJogo['publisher'],
            'game_picture' => $this->loadFixtureImage('pacman.jpg'),
        ]);

        $response->assertSessionHasErrors(['release_date']);
    }

    // TESTE ADICIONADO (faltava no atual)
    public function test_nao_deve_cadastrar_jogo_com_logo_em_formato_invalido()
    {
        $response = $this->post('/games/register', [
            'name' => $this->dadosJogo['name'],
            'description' => $this->dadosJogo['description'],
            'release_date' => $this->dadosJogo['release_date'],
            'developer' => $this->dadosJogo['developer'],
            'publisher' => $this->dadosJogo['publisher'],
            'game_picture' => UploadedFile::fake()->create('rick.gif', 100, 'image/gif'),
        ]);

        $response->assertSessionHasErrors(['game_picture']);
    }

    public function test_deve_cadastrar_jogo_com_sucesso()
    {
        $response = $this->post('/games/register', $this->dadosJogo);
        $response->assertRedirect('/games');

        $this->assertDatabaseHas('games', [
            'name' => $this->dadosJogo['name'],
            'description' => $this->dadosJogo['description'],
        ]);

        $game = Game::first();
        $this->assertFileExists(public_path($game->game_picture));
    }

    // Edição

    // TESTE ADICIONADO (faltava no atual)
    public function test_deve_permitir_editar_jogo_sem_alterar_informacoes()
    {
        $this->post('/games/register', $this->dadosJogo);
        $jogo = Game::first();

        $response = $this->put("/games/{$jogo->uuid}", collect($jogo->toArray())->except('game_picture')->all());

        $response->assertRedirect(route('games.index'));

    }

    // TESTE ADICIONADO (faltava no atual)
    public function test_nao_deve_permitir_editar_jogo_com_nome_ja_existente()
    {
        $this->post('/games/register', $this->dadosJogo);
        $this->post('/games/register', $this->dadosJogo2);
        
        $jogo1 = Game::first();
        $jogo2 = Game::latest('uuid')->first();

        $dados = $jogo2->toArray();
        $dados['name'] = $jogo1->name;
        $dados['game_picture'] = $this->loadFixtureImage('ps1.jpg');

        $response = $this->put("/games/{$jogo2->uuid}", $dados);
        $response->assertSessionHasErrors(['name']);
    }

    public function test_deve_editar_jogo_com_sucesso()
    {
        $this->post('/games/register', $this->dadosJogo);
        $game = Game::first();

        $novosDados = [
            'name' => 'Zelda: Tears of the Kingdom',
            'description' => 'A sequência de Breath of the Wild',
            'release_date' => '2023-05-12',
            'developer' => 'Nintendo EPD',
            'publisher' => 'Nintendo',
            'game_picture' => $this->loadFixtureImage('ps1.jpg'),
        ];

        $response = $this->put("/games/{$game->uuid}", $novosDados);
        $response->assertRedirect('/games');

        $this->assertDatabaseHas('games', [
            'uuid' => $game->uuid,
            'name' => 'Zelda: Tears of the Kingdom',
        ]);

        $game->refresh();
        $this->assertFileExists(public_path($game->game_picture));
    }

    // Exclusão

    public function test_deve_remover_jogo_existente()
    {
        $this->post('/games/register', $this->dadosJogo);
        $game = Game::first();
        $imagePath = $game->game_picture;

        $response = $this->delete("/games/{$game->uuid}");
        $response->assertRedirect('/games');

        $this->assertDatabaseMissing('games', ['uuid' => $game->uuid]);
        $this->assertFileDoesNotExist(public_path($imagePath));
    }
}