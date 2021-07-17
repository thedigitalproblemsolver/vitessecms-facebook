<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Forms;

use VitesseCms\Form\AbstractFormWithRepository;
use VitesseCms\Form\Interfaces\FormWithRepositoryInterface;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\facebook\Enums\SettingEnum;

class oAuthForm extends AbstractFormWithRepository
{
    public function buildForm(): FormWithRepositoryInterface
    {
        if(!$this->setting->has(SettingEnum::FACEBOOK_APP_ID,false)):
            $this->addText(
                '%FACEBOOK_APP_ID%',
                SettingEnum::FACEBOOK_APP_ID,
                (new Attributes())->setRequired()
            );
        endif;

        if(!$this->setting->has(SettingEnum::FACEBOOK_APP_SECRET, false)):
            $this->addText(
                '%FACEBOOK_APP_SECRET%',
                SettingEnum::FACEBOOK_APP_SECRET,
                (new Attributes())->setRequired()
            );
        endif;

        $this->addSubmitButton('%CORE_SAVE%');

        return $this;
    }
}
