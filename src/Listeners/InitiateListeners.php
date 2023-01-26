<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use VitesseCms\Core\AbstractController;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Facebook\Listeners\Admin\AdminMenuListener;
use VitesseCms\Facebook\Listeners\Controllers\AbstractControllerListener;


class InitiateListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        if ($di->user->hasAdminAccess()):
            $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        endif;
        $di->eventsManager->attach(AbstractController::class, new AbstractControllerListener(
            $di->eventsManager,
            $di->setting
        ));
    }
}