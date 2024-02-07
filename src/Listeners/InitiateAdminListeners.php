<?php
declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use VitesseCms\Communication\Fields\SocialShare;
use VitesseCms\Core\Interfaces\InitiateListenersInterface;
use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Facebook\Listeners\Admin\AdminMenuListener;
use VitesseCms\Facebook\Listeners\Fields\SocialShareListener;

class InitiateAdminListeners implements InitiateListenersInterface
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        $injectable->eventsManager->attach('adminMenu', new AdminMenuListener());
        $injectable->eventsManager->attach(SocialShare::class, new SocialShareListener());
        /*$di->eventsManager->attach(MediaEnum::ASSETS_LOAD_GENERIC, new AssetsListener(
            $di->configuration->getVendorNameDir(),
            $di->setting->has(CallingNameEnum::FACEBOOK_PIXEL_ID)
        ));*/

        /**
         * not ready because facebook app needs a business verification
         * before an application can post on a users timeline
         */
        /*if(
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
        endif;*/
    }
}
