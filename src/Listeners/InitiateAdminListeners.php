<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use VitesseCms\Communication\Fields\SocialShare;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Facebook\Listeners\Fields\SocialShareListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(SocialShare::class, new SocialShareListener());
    }
}
