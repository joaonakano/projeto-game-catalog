<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_tela_de_cadastro_pode_ser_carregada(): void
    {
        $resposta = $this->get('/register');
        $resposta->assertStatus(200);
    }

    public function test_novo_usuario_pode_se_cadastrar_sem_imagem(): void
    {
        $resposta = $this->post('/register', [
            'name' => 'Usuário de Teste',
            'email' => 'teste@exemplo.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $this->assertAuthenticated();
        $resposta->assertRedirect(route('games.index'));
    }

    public function test_usuario_pode_se_cadastrar_com_imagem(): void
    {
        // Limpa a pasta public/pictures para garantir ambiente limpo
        File::deleteDirectory(public_path('pictures'));

        // Cria uma imagem fake para simular o upload
        $imagemFake = UploadedFile::fake()->image('foto.jpg');

        // Envia o formulário de cadastro incluindo a imagem
        $resposta = $this->post('/register', [
            'name' => 'Usuário com Imagem',
            'email' => 'imagem@exemplo.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
            'picture' => $imagemFake,
        ]);

        // Verifica se foi redirecionado corretamente
        $resposta->assertRedirect(route('games.index'));

        // Verifica se o usuário foi criado no banco de dados
        $this->assertDatabaseHas('users', [
            'email' => 'imagem@exemplo.com',
        ]);

        // Busca o usuário criado
        $usuario = User::where('email', 'imagem@exemplo.com')->first();

        // Verifica se o campo picture foi preenchido
        $this->assertNotEmpty($usuario->picture);

        // Verifica se o arquivo da imagem foi salvo na pasta public/pictures
        $this->assertFileExists(public_path($usuario->picture));
    }
}
