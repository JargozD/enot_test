<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Request;
use App\Session;
use App\Router;

Session::start();

(new Router())->execute(
    new Request(),
    new Session()
);