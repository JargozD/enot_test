<?php

namespace App;

class Request
{
    private array $urlData = [];

    private array $params = [];

    public function __construct()
    {
        $this->urlData = parse_url($_SERVER['REQUEST_URI']);
        $this->params = $_REQUEST;
    }

    public function getPath()
    {
        return $this->urlData['path'] ?? null;
    }

    public function getParams()
    {
        return $this->params;
    }
}