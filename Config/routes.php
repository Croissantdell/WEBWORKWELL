<?php

/**
 * Analyse l'URL pour extraire le contrôleur, l'action et les paramètres.
 *
 * @return array Composants de l'URL analysée.
 */
function parseUrl() {
    $dossierBase = 'P2025/WEBWORKWELL';
    $url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    // Retire le dossier de base de l'URL si présent
    if (strpos($url, $dossierBase) === 0) {
        $url = substr($url, strlen($dossierBase));
    }

    $url = trim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Divise l'URL en composants
    return explode('/', $url);
}

/**
 * Charge et exécute l'action spécifiée du contrôleur.
 *
 * @param string $controller Le nom du contrôleur.
 * @param string $action Le nom de la méthode d'action.
 * @param mixed $id Le paramètre pour la méthode d'action.
 */
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

/**
 * Affiche un message d'erreur et arrête l'exécution.
 *
 * @param string $message Le message d'erreur.
 */
function erreur($message) {
    http_response_code(404);
    echo "<h1>Page introuvable</h1>";
    echo "<p>$message</p>";
    exit();
}

/**
 * Fonction principale pour analyser l'URL et charger le contrôleur approprié.
 */
function main() {
    $url = parseUrl();

    $controller = !empty($url[0]) ? $url[0] : 'accueil';
    $action = !empty($url[1]) ? $url[1] : 'index';
    $id = $url[2] ?? null;

    loadController($controller, $action, $id);
}

main();
