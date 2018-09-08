<?php

return [
    '__name' => 'lib-user-auth-jwt',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-user-auth-jwt.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-user-auth-jwt' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'lib-user' => NULL
            ],
            [
                'lib-jwt' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'LibUserAuthJwt\\Authorizer' => [
                'type' => 'file',
                'base' => 'modules/lib-user-auth-jwt/authorizer'
            ]
        ],
        'files' => []
    ],
    'libUser' => [
        'authorizers' => [
            'jwt' => 'LibUserAuthJwt\\Authorizer\\Jwt'
        ]
    ],
    'libUserAuthJwt' => [
        'expires' => 604800
    ]
];