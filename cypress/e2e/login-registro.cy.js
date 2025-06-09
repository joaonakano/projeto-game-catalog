const USER_INFO = {
  'name': 'Mojo',
  'email': `${Date.now()}@gmail.com`,
  'password': 'Mojo1234!'
}

const REAL_USER_INFO = {
  'name': 'Joao',
  'email': 'joao@gmail.com',
  'password': 'Joao1234!'
}

const SERVER_PORT = 8000;
const SERVER_IP = '127.0.0.1';

const SERVER_URL = `http://${SERVER_IP}:${SERVER_PORT}`;

// Registro
describe("Registro", () => {
  beforeEach(() => {
      cy.visit(`${SERVER_URL}/register`);
      cy.url().should('contain', 'register');
  })

  it("Tentativa de Registro com Payload Vazio", () => {
    cy.get("#name").type("  ");
    cy.get("#email").type(" ");
    cy.get("#password").type("  ");
    cy.get("#password_confirmation").type("  ");

    cy.get('form').submit();

    cy.get("ul").get('li:contains(is required)').should('have.length', 3);
  });

  it("Tentativa de Registro com Senhas Diferentes", () => {
    cy.get("#name").type(USER_INFO.name);
    cy.get("#email").type(USER_INFO.email);
    cy.get("#password").type(USER_INFO.password);
    cy.get("#password_confirmation").type("skibidi");

    cy.get("form").submit();

    cy.get("ul").get("li:contains(does not match)").should("have.length", 1);
  });

  it("Registro Normal", () => {
    cy.get("#name").type(REAL_USER_INFO.name);
    cy.get("#email").type(REAL_USER_INFO.email);
    cy.get("#password").type(REAL_USER_INFO.password);
    cy.get("#password_confirmation").type(REAL_USER_INFO.password);

    cy.get("form").submit();

    cy.url().should("contain", "/games");
  });
});

// Login
describe("Login", () => {
  beforeEach(() => {
    cy.visit(`${SERVER_URL}/login`);
    cy.url().should('contain', 'login');
  });

  it('Tentativa de Acesso de Rota Segura sem Login', () => {
    cy.visit(`${SERVER_URL}/games`);

    cy.url().should('contain', 'login');
  });

  it('Tentativa de Acesso com Login inexistente', () => {
    cy.get('#email').type(`110011${USER_INFO.email}`);
    cy.get('#password').type(USER_INFO.password);
    cy.get('form').submit();

    cy.contains('These credentials do not match our records.');
  });

  it('Tentativa de Acesso com Payload Vazio', () => {
    cy.get('#email').type(' ');
    cy.get('#password').type(' ');
    cy.get('form').submit();

    cy.get("ul").get('li:contains(is required)').should('have.length', 2);
    cy.contains('The password field is required.');
  });

  it('Tentativa de Recuperação com E-mail Inválido', () => {
    cy.visit(`${SERVER_URL}/forgot-password`);
    cy.url().should('contain', 'forgot-password');

    cy.get('#email').type('11111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111@gmail.com');
    cy.get('form').submit();

    cy.contains("We can't find a user with that email address.");
  });

  it('Tentativa de Login Normal', () => {
    cy.session(REAL_USER_INFO.name, () => {
      cy.visit(`${SERVER_URL}/login`);
      cy.get("#email").type(REAL_USER_INFO.email);
      cy.get("#password").type(REAL_USER_INFO.password);
      cy.get('form').submit();

      cy.url().should('contain', '/games');
    })
  });
});