<?php

return [
    'accueil' => [
        'controller' => 'AccueilController',
        'action' => 'index'
    ],
    'oeuvre' => [
        'controller' => 'OeuvreController',
        'actions' => [
            'index' => 'index',
            'voir' => 'voir', // exemple d'une action avec un ID
            'ajouter' => 'ajouter',
            'editer' => 'editer',
            'supprimer' => 'supprimer'
        ]
    ],
    'acteur' => [
        'controller' => 'ActeurController',
        'actions' => [
            'index' => 'index',
            'voir' => 'voir',
            'ajouter' => 'ajouter',
            'editer' => 'editer',
            'supprimer' => 'supprimer'
        ]
    ],
    'realisateur' => [
        'controller' => 'RealisateurController',
        'actions' => [
            'index' => 'index',
            'voir' => 'voir',
            'ajouter' => 'ajouter',
            'editer' => 'editer',
            'supprimer' => 'supprimer'
        ]
    ],
    'authentification' => [
        'controller' => 'AuthentificationController',
        'actions' => [
            'login' => 'login',
            'logout' => 'logout',
            'register' => 'register'
        ]
    ],
    'genre' => [
        'controller' => 'GenreController',
        'actions' => [
            'index' => 'index',
            'voir' => 'voir',
            'ajouter' => 'ajouter',
            'editer' => 'editer',
            'supprimer' => 'supprimer'
        ]
    ],
    'classification' => [
        'controller' => 'ClassificationController',
        'actions' => [
            'index' => 'index',
            'voir' => 'voir',
            'ajouter' => 'ajouter',
            'editer' => 'editer',
            'supprimer' => 'supprimer'
        ]
    ],
    // Ajoutez d'autres routes selon vos besoins
];

