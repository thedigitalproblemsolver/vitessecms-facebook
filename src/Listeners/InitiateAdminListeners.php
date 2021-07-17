<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use Facebook\Facebook;
use VitesseCms\Communication\Fields\SocialShare;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Facebook\Enums\SettingEnum;
use VitesseCms\Facebook\Listeners\Admin\AdminMenuListener;
use VitesseCms\Facebook\Listeners\Fields\SocialShareListener;
use VitesseCms\Facebook\Services\FacebookService;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach('adminMenu', new AdminMenuListener());
        if(
            $di->setting->has(SettingEnum::FACEBOOK_APP_ID)
            && $di->setting->has(SettingEnum::FACEBOOK_APP_SECRET)
        ) :
            $di->eventsManager->attach(SocialShare::class, new SocialShareListener(
                new FacebookService(
                    new Facebook([
                        'app_id' => $di->setting->getString(SettingEnum::FACEBOOK_APP_ID),
                        'app_secret' => $di->setting->getString(SettingEnum::FACEBOOK_APP_SECRET),
                        'default_graph_version' => 'v11.0'
                    ]),
                    $di->log,
                    $di->url->getBaseUri()
                )
            ));
        endif;
    }
}
