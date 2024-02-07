<?php
declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use VitesseCms\Core\AbstractController;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Facebook\Listeners\Admin\AdminMenuListener;
use VitesseCms\Facebook\Listeners\Controllers\AbstractControllerListener;


class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        if ($injectable->user->hasAdminAccess()):
            $injectable->eventsManager->attach('adminMenu', new AdminMenuListener());
        endif;
        $injectable->eventsManager->attach(
            AbstractController::class,
            new AbstractControllerListener(
                $injectable->eventsManager,
                $injectable->setting
            )
        );
    }
}