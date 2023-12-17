<?php

namespace App;

use App\Repository\UsersRepository;

class Session
{
    private array $data = [];
    private static ?array $user = null;

    public function __construct()
    {
        $this->data = $_SESSION;

        if (!static::$user && ($this->data['userId'] ?? null)) {
            static::$user = (new UsersRepository())->getById($this->data['userId']);
        }
    }

    public static function start()
    {
        session_start();
    }

    public static function close()
    {
        session_unset();
    }

    public static function set(array $data)
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function getPath()
    {
        return $this->data['path'] ?? null;
    }

    public function getUserLogin()
    {
        return static::$user['login'] ?? '';
    }

    public function isAuth()
    {
        return (bool) static::$user;
    }
}
