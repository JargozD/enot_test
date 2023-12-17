<?php

namespace App\Helper;

use App\Session;

class Template
{    
    public static function render(string $viewPath, array $params = [], string $layout = 'default')
    {
        $session = new Session();

        $basePath = __DIR__. '/../View';

        include "$basePath/Layout/$layout/header.php";
        include "$basePath/$viewPath";
        include "$basePath/Layout/$layout/footer.php";
    }
}
