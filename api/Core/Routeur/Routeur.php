<?php
namespace Core\Routeur;

use Core\Trait\JsonTrait;

final class Routeur {

    use JsonTrait;

    public static function Routes (){
        try {
            // On casse le path info pour récupérer le nom du controller à instancier
            // ainsi que l'id de l'élément à récupérer ou la méthode à exécuter.
            $path = explode("/", $_SERVER['PATH_INFO']);
            
            // On génère le nom du controller
            $controllerName = "App\Controller\\". ucfirst($path[3]). "Controller";

            // On instancie le controller
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
            } else {
                throw new \Exception("Classe inéxistante", 404);
            }

            // Vérification du paramètre suivant de l'url
            $param = null;

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (isset($path[4]) && is_numeric($path[4])) {
                        $controller->getOne($path[4]);
                    } else {
                        $controller->getAll();
                    }
                    break;
                case 'POST':
                    if (!empty($_POST)) {
                        $controller->save($_POST);
                    }
                    break;
            }

            if (isset($path[4])) {
                if (is_numeric($path[4])) {
                    $method = "getOne";
                    $param = $path[4];
                } elseif (method_exists($controller, $path[4])) {
                    $method = $path[4];
                } else {
                    throw new \Exception("Méthode inexistante", 404);
                }
            } else {
                $method = "getAll";
            }

            $controller->$method($param);

        } catch (\Exception $e) {
            self::jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}
