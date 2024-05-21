<?php
ob_start();



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    } else {
        echo "Fichier introuvable pour la classe : $class<br>";
    }
});

/**
 * Inclut le fichier de routes et déclare les fonctions nécessaires
 */
require_once __DIR__ . '/Config/routes.php';

if (!function_exists('parseUrl')) {
    function parseUrl() {
        $dossierBase = 'P2025/WEBWORKWELL';
        $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');


        if (strpos($url, $dossierBase) === 0) {
            $url = substr($url, strlen($dossierBase));
        }

        $url = trim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);

        return explode('/', $url);
    }
}

if (!function_exists('loadController')) {
    function loadController($controller, $action = 'index', $id = null) {
        $classeController = 'Controller\\' . ucfirst($controller) . 'Controller';
        $methodeAction = $action;


        if (class_exists($classeController)) {
            $instanceController = new $classeController();

            if (method_exists($instanceController, $methodeAction)) {
                if ($id !== null) {
                    $instanceController->{$methodeAction}($id);
                } else {
                    $instanceController->{$methodeAction}();
                }
            } else {
                erreur("Action introuvable : $methodeAction dans le contrôleur $classeController");
            }
        } else {
            erreur("Contrôleur introuvable : $classeController");
        }
    }
}

if (!function_exists('erreur')) {
    function erreur($message) {
        http_response_code(404);
        echo "<h1>Page introuvable</h1>";
        echo "<p>$message</p>";
        exit();
    }
}

if (!function_exists('main')) {
    function main() {
        $url = parseUrl();

        $controller = !empty($url[0]) ? $url[0] : 'accueil';
        $action = !empty($url[1]) ? $url[1] : 'index';
        $id = $url[2] ?? null;



        loadController($controller, $action, $id);
    }
}

main();
ob_end_flush();
