<?php

/**
 * Fonction d'autoload pour inclure les fichiers de classe.
 *
 * @param string $class Le nom complet de la classe.
 */
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/';

    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Inclut le fichier de routes
require 'config/routes.php';
