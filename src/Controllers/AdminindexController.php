<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Controllers;

use stdClass;
use VitesseCms\Admin\AbstractAdminController;
use VitesseCms\Configuration\Enums\ConfigurationEnum;
use VitesseCms\Configuration\Services\ConfigService;
use VitesseCms\Core\Enum\FlashEnum;
use VitesseCms\Core\Enum\ViewEnum;
use VitesseCms\Core\Services\FlashService;
use VitesseCms\Core\Services\ViewService;
use VitesseCms\Facebook\Enums\SettingEnum;
use VitesseCms\Facebook\Forms\oAuthForm;
use VitesseCms\Setting\Enum\TypeEnum;
use VitesseCms\Setting\Factory\SettingFactory;
use VitesseCms\Setting\Services\SettingService;

class AdminindexController extends AbstractAdminController
{
    /**
     * @var SettingService
     */
    private $setting;

    /**
     * @var ViewService
     */
    private $view;

    /**
     * @var ConfigService
     */
    private $configuration;

    /**
     * @var FlashService
     */
    private $flash;

    public function onConstruct()
    {
        parent::onConstruct();

        $this->setting = $this->eventsManager->fire(\VitesseCms\Setting\Enum\SettingEnum::ATTACH_SERVICE_LISTENER, new stdClass());
        $this->view = $this->eventsManager->fire(ViewEnum::ATTACH_SERVICE_LISTENER, new stdClass());
        $this->configuration = $this->eventsManager->fire(ConfigurationEnum::ATTACH_SERVICE_LISTENER, new stdClass());
        $this->flash = $this->eventsManager->fire(FlashEnum::ATTACH_SERVICE_LISTENER, new stdClass());
    }

    public function indexAction(): void
    {
        $form = null;

        if (
            !$this->setting->has(SettingEnum::FACEBOOK_APP_ID, false)
            || !$this->setting->has(SettingEnum::FACEBOOK_APP_SECRET, false)
        ):
            $form = (new oAuthForm())->buildForm()->renderForm('admin/facebook/adminindex/parseadminindexform');
        endif;

        $this->view->setVar('content', $this->view->renderTemplate(
            'adminIndex',
            $this->configuration->getVendorNameDir() . 'facebook/src/Resources/views/admin/',
            [
                'form' => $form,
                'settingsLink' => 'admin/setting/adminsetting/adminList?filter[name.nl]=facebook',
            ]
        ));

        $this->prepareView();
    }

    public function parseadminindexformAction(): void
    {
        if ($this->request->has(SettingEnum::FACEBOOK_APP_ID)) :
            SettingFactory::create(
                SettingEnum::FACEBOOK_APP_ID,
                TypeEnum::TEXT,
                $this->request->get(SettingEnum::FACEBOOK_APP_ID),
                '',
                true
            )->save();
        endif;

        if ($this->request->has(SettingEnum::FACEBOOK_APP_SECRET)) :
            SettingFactory::create(
                SettingEnum::FACEBOOK_APP_SECRET,
                TypeEnum::TEXT,
                $this->request->get(SettingEnum::FACEBOOK_APP_SECRET),
                '',
                true
            )->save();
        endif;

        $this->flash->setSucces('%ADMIN_SETTINGS_CREATED%');

        $this->redirect('admin/facebook/adminindex/index');
    }
}
