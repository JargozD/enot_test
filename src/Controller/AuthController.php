<?php

namespace App\Controller;

use App\Helper\Template;
use App\Repository\UsersRepository;
use App\Router;
use App\Session;

class AuthController extends BaseController
{
    public function login()
    {
        $params = $this->request->getParams();
        $login = $params['login'] ?? null;
        $password = $params['password'] ?? null;
        $errors = [];
        
        if ($login && $password) {
            $userRepository = new UsersRepository();
            $user = $userRepository->getOne(['login' => $login]);
            if (!$user) {
                $errors[] = 'Пользователь не найден.';
            } elseif (!password_verify($password, $user['password_hash'])) {
                $errors[] = 'Неверный пароль.';
            } else {
                Session::set(['userId' => $user['id']]);
                Router::redirect('/');
            }
        }
        
        Template::render(
            "login.php",
            [
                'login' => $login,
                'password' => $password,
                'errors' => $errors
            ],
            "simple"
        );
    }

    public function logout()
    {
        Session::close();
        Router::redirect('/');
    }

    public function registration()
    {
        $params = $this->request->getParams();
        $login = $params['login'] ?? null;
        $password = $params['password'] ?? null;
        $password2 = $params['password2'] ?? null;
        $errors = [];

        if ($login && $password && $password2) {
            if ($password != $password2) {
                $errors[] = 'Пароли не совпадают.';
            } else {
                $userRepository = new UsersRepository();
                $user = $userRepository->getOne(['login' => $login]);
                if ($user) {
                    $errors[] = 'Пользователь с таким логином уже существует.';
                } else {
                    $userRepository->add([
                        'login' => $login,
                        'password_hash' => password_hash($password, PASSWORD_BCRYPT)
                    ]);

                    Router::redirect('/login');
                }
            }
        }

        Template::render(
            "registration.php",
            [
                'login' => $login,
                'password' => $password,
                'password2' => $password2,
                'errors' => $errors
            ],
            "simple"
        );
    }
}
