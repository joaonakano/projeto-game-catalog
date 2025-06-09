const REAL_USER_INFO = {
  'email': 'joao@gmail.com',
  'password': 'Joao1234!'
}

const GAME_INFO = {
    'name': 'Cowboy Redemption',
    'description': 'A first-person gun-shooter duel online battle between two worms.',
    'release_date': '2022-07-02',
    'developer': 'John Games',
    'publisher': 'John Games North-America'
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
        cy.get("[name=name]").type(1234);
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();
        cy.screenshot('Registro-Somente-Numeros');
    });

    it("Tentando Registrar um Jogo somente com Símbolos no Nome", () => {
        cy.get("[name=name]").type("!@#$!@#$!@#$!@#$!@#$!@#$!@#$!@#$$%^*())))))----====++++/;;;;..,,,");
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type(GAME_INFO.release_date);
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();

        cy.contains('Título tem caracteres inválidos');
        cy.screenshot('Registro-Somente-Caracteres-Invalidos');
    });

    it("Tentando Registrar um Jogo com muitos Caracteres no Nome", () => {
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
        cy.get("[name=name]").type(GAME_INFO.name);
        cy.get("[name=description]").type(GAME_INFO.description);
        cy.get("[name=release_date]").type("1500-01-07");
        cy.get("[name=developer]").type(GAME_INFO.developer);
        cy.get("[name=publisher]").type(GAME_INFO.publisher);

        cy.get('button').contains("Cadastrar").click();
        cy.contains('Data informada é muito anterior ao prazo esperado');
    });
})