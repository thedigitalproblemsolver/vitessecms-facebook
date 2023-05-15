<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Controllers;

use VitesseCms\Core\AbstractControllerFrontend;

class IndexController extends AbstractControllerFrontend
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
