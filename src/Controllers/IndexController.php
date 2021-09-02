<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Controllers;

use VitesseCms\Core\AbstractController;

class IndexController extends AbstractController
{
    public function loginCallbackAction()
    {
        var_dump('in loginCallbackAction');
        die();
    }

    public function getUserPostByItem(): void
    {
        
    }
}
