<?php

namespace App\Controller;

use App\Request;
use App\Session;

class BaseController
{
    public function __construct(
        protected Request $request,
        protected Session $session
    )
    {
    }
}