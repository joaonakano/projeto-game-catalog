// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

const SERVER_PORT = 8000;
const SERVER_IP = '127.0.0.1';

const SERVER_URL = `http://${SERVER_IP}:${SERVER_PORT}`;

Cypress.Commands.add('login', (user) => {
    
    const { email, password } = user;
    const chaveSessao = `login-${email}`;

    cy.session(chaveSessao, () => {
        cy.visit(`${SERVER_URL}/login`);
        cy.get("#email").type(email);
        cy.get("#password").type(password);
        cy.get('form').submit();
        cy.url().should('contain', '/games');
    });
});