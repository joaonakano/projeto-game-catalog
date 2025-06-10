const REAL_USER_INFO = {
  'email': 'joao@gmail.com',
  'password': 'Joao1234!'
}

const GAME_INFO = {
    'name': 'Cowboy Redemption',
    'description': 'A first-person gun-shooter duel online battle between two worms.',
    'release_date': '2022-07-02',
    'developer': 'John Games',
    'publisher': 'John Games North-America',
    'logo': 'cypress/fixtures/logo.jpg'
}

const GAME_2_INFO = {
    'name': 'Minecraft',
    'description': 'Create a brand new world.',
    'release_date': '2005-07-02',
    'developer': 'Mojang',
    'publisher': 'Mojang',
    'logo': 'cypress/fixtures/logo.jpg'
}

const SERVER_PORT = 8000;
const SERVER_IP = '127.0.0.1';

const SERVER_URL = `http://${SERVER_IP}:${SERVER_PORT}`;


describe("Cadastro de Jogo", () => {
    beforeEach(() => {
        cy.login(REAL_USER_INFO);
        cy.visit(`${SERVER_URL}/games/register`);
    });

    it("Tentando Registrar um Jogo com Payload Vazio", () => {
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type("    ");
        cy.get("[name=description]").type("    ");
        cy.get("[name=release_date]").type("2022-02-23");
        cy.get("[name=developer]").type("    ");
        cy.get("[name=publisher]").type("    ");

        cy.get('button').contains("Cadastrar").click();

        cy.get('ul').get('li:contains(é obrigató)').should('have.length', 4);
        cy.screenshot('Registro-Playload-Vazio');
    });

    it("Tentando Registrar um Jogo somente com Números no Nome", () => {
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type(1234);
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();

        cy.contains("Jogo registrado com sucesso!").should("exist");;
        cy.screenshot('Registro-Somente-Numeros');
    });

    it("Tentando Registrar um Jogo somente com Símbolos no Nome", () => {
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type("!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$$%^*())))))----====++++/;;;;..,,,");
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();

        cy.contains('Título tem caracteres inválidos').should("exist");
        cy.screenshot('Registro-Somente-Caracteres-Invalidos');
    });

    it("Tentando Registrar um Jogo com muitos Caracteres no Nome", () => {
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type("oi".repeat(500));
        cy.get("[name=description]").type("descricao".repeat(100));
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type("tchau".repeat(100));
        cy.get("[name=publisher]").type("skibidi".repeat(100));

        cy.get('button').contains("Cadastrar").click();

        cy.get('ul').get('li:contains(requer no máximo)').should('have.length', 4);
        cy.screenshot("Registro-Muitos-Caracteres");
    });

    it("Tentando Registrar um Jogo com Data Errada", () => {
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type(GAME_INFO.name);
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type("1500-01-07");
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();

        cy.contains('Data informada é muito anterior ao prazo esperado').should("exist");
        cy.screenshot("Registro-Data-Errada");
    });

    it("Tentando Registrar um Jogo com um GIF ao invés de Imagem Válida", () => {
        cy.get("#game_picture").selectFile("cypress/fixtures/rick.gif");
        cy.get("[name=name]").type("Rick");
        cy.get("[name=description]").type("Rick roll!");
        cy.get("[name=release_date]").type("2022-03-21");
        cy.get("[name=developer]").type("Trolling Studios");
        cy.get("[name=publisher]").type("SteamOS");

        cy.get('button').contains("Cadastrar").click();
        
        cy.contains("imagem deve ser do tipo jpg, png ou jpeg").should("exist");
        cy.screenshot("Registro-Arquivo-Invalido");
    });

    it("Registrando o Jogo Corretamente", () => {
        // Jogo 1
        cy.get("#game_picture").selectFile(GAME_INFO.logo);
        cy.get("[name=name]").type(GAME_INFO.name);
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();

        // Jogo 2
        cy.visit(`${SERVER_URL}/games/register`);
        cy.get("#game_picture").selectFile(GAME_2_INFO.logo);
        cy.get("[name=name]").type(GAME_2_INFO.name);
        cy.get("[name=description]").type(GAME_2_INFO.description);
        cy.get("[name=release_date]").type(GAME_2_INFO.release_date);
        cy.get("[name=developer]").type(GAME_2_INFO.developer);
        cy.get("[name=publisher]").type(GAME_2_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();
    });
});

describe("Edição de Jogo", () => {
    beforeEach(() => {
        cy.login(REAL_USER_INFO)
        cy.visit(`${SERVER_URL}/games`);
        cy.get("[title=Editar]").first().click();
    });

    it("Tentando Editar um Jogo sem Modificar Informações", () => {
        cy.contains("Atualizar Jogo").click();
    })

    it("Editando as Informações para um Jogo que já Existe no Banco de Dados", () => {
        cy.get("#game_picture").selectFile(GAME_2_INFO.logo);
        cy.get("[name=name]").clear().type(GAME_2_INFO.name);
        cy.get("[name=description]").clear().type(GAME_2_INFO.description);
        cy.get("[name=release_date]").clear().type(GAME_2_INFO.release_date);
        cy.get("[name=developer]").clear().type(GAME_2_INFO.developer);
        cy.get("[name=publisher]").clear().type(GAME_2_INFO.publisher);

        cy.contains("Atualizar Jogo").click();

        cy.contains("Título já registrado").should("exist");
        cy.screenshot("Edicao-Jogo-Ja-Registrado");
    });

    it("Editando as Informações Normalmente", () => {
        cy.get("[name=name]").clear().type("Jogo Editado");
        cy.get("[name=description]").clear().type("Teste de Edição de Jogo");
        cy.get("[name=developer]").clear().type("Desenvolvedora Editado");
        cy.get("[name=publisher]").clear().type("Distribuidora Editado");

        cy.contains("Atualizar Jogo").click();

        cy.contains("Registro atualizado com sucesso!").should("exist");
    });
});

describe("Remoção de Jogo", () => {
    beforeEach(() => {
        cy.login(REAL_USER_INFO)
        cy.visit(`${SERVER_URL}/games`);
    });

    it("Remoção de um Jogo Existente", () => {
        cy.get("#delete-button").submit();
        cy.contains("Jogo removido com sucesso!").should("exist");
        cy.screenshot("Delete-Jogo");
    });
});