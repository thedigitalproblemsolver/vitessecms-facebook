<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Controllers;

use VitesseCms\Admin\AbstractAdminController;
use VitesseCms\Setting\Enum\TypeEnum;
use VitesseCms\Setting\Factory\SettingFactory;
use VitesseCms\Facebook\Enums\SettingEnum;
use VitesseCms\Facebook\Forms\oAuthForm;

class AdminindexController extends AbstractAdminController
{
    public function onConstruct()
    {
        parent::onConstruct();
    }

    public function indexAction(): void
    {
        $form = null;

        if(
            !$this->setting->has(SettingEnum::FACEBOOK_APP_ID,false)
            || !$this->setting->has(SettingEnum::FACEBOOK_APP_SECRET,false)
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
        if($this->request->has(SettingEnum::FACEBOOK_APP_ID)) :
            SettingFactory::create(
                SettingEnum::FACEBOOK_APP_ID,
                TypeEnum::TEXT,
                $this->request->get(SettingEnum::FACEBOOK_APP_ID),
                '',
                true
            )->save();
        endif;

        if($this->request->has(SettingEnum::FACEBOOK_APP_SECRET)) :
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
