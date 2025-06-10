<?php

return [
    'required' => 'O campo :attribute é obrigatório.',
    'string' => 'O campo :attribute deve ser um texto válido.',
    'min' => [
        'string' => 'O campo :attribute deve ter no mínimo :min caracteres.',
        'file' => 'O campo :attribute deve ter no mínimo :min kilobytes.',
        'numeric' => 'O campo :attribute deve ser no mínimo :min.',
        'array' => 'O campo :attribute deve ter no mínimo :min itens.',
    ],
    'max' => [
        'string' => 'O campo :attribute deve ter no máximo :max caracteres.',
        'file' => 'O campo :attribute deve ter no máximo :max kilobytes.',
        'numeric' => 'O campo :attribute deve ser no máximo :max.',
        'array' => 'O campo :attribute deve ter no máximo :max itens.',
    ],
    'email' => 'O campo :attribute deve ser um email válido.',
    'confirmed' => 'A confirmação de :attribute não coincide.',
    'unique' => 'O valor do campo :attribute já está em uso.',
    'file' => 'O campo :attribute deve ser um arquivo válido.',
    'mimes' => 'O campo :attribute deve ser do tipo: :values.',
    'lowercase' => 'O campo :attribute deve estar em letras minúsculas.',

    'attributes' => [
        'name' => 'nome de usuário',
        'email' => 'email',
        'password' => 'senha',
        'password_confirmation' => 'confirmação de senha',
        'picture' => 'imagem de perfil',
    ],
];