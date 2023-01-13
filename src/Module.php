<?php declare(strict_types=1);

namespace VitesseCms\Facebook;

use Phalcon\Di\DiInterface;
use VitesseCms\Core\AbstractModule;

class Module extends AbstractModule
{
    public function registerServices(DiInterface $di, string $string = null)
    {
        parent::registerServices($di, 'Facebook');
    }

    public function getAdminServices(DiInterface $di): void
    {
        /*$di->setShared('facebook',new FacebookService(
            new Facebook([
                'app_id' => $di->setting->getString(SettingEnum::FACEBOOK_APP_ID),
                'app_secret' => $di->setting->getString(SettingEnum::FACEBOOK_APP_SECRET),
                'default_graph_version' => 'v11.0'
            ]),
            $di->log,
            $di->url->getBaseUri()
        ));*/
    }
}
