<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Controllers;

use VitesseCms\Admin\AbstractAdminController;

class IndexController extends AbstractAdminController
{
    public function loginCallbackAction()
    {
        var_dump('in loginCallbackAction');
        die();
    }
}
