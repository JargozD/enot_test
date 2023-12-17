<?php

namespace App;

use App\Request;
use App\Session;
use App\Controller\AuthController;
use App\Controller\MainController;

class Router
{
    private const ROUTES = [
        '/login' => ['controller' => AuthController::class, 'method' => 'login'],
        '/logout' => ['controller' => AuthController::class, 'method' => 'logout'],
        '/registration' => ['controller' => AuthController::class, 'method' => 'registration'],
        '/' => ['controller' => MainController::class, 'method' => 'calculator', 'needAuth' => true, 'redirect' => '/login']
    ];

    public function execute(Request $req, Session $session)
    {
        foreach (self::ROUTES as $route => $data) {
            if (str_starts_with($req->getPath(), $route)) {
                if (($data['needAuth'] ?? false) && !$session->isAuth()) {
                    self::redirect($data['redirect']);
                }
                (new $data['controller']($req, $session))->{$data['method']}();
                break;
            }
        }
    }

    public static function redirect(string $path)
    {
        header('Location: ' . $path, true, 302);

        exit();
    }
}
