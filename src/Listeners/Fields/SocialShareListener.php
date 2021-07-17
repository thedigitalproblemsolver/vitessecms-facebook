<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners\Fields;

use Phalcon\Events\Event;
use VitesseCms\Content\Models\Item;
use VitesseCms\Database\AbstractCollection;
use VitesseCms\Datafield\Models\Datafield;
use VitesseCms\Facebook\Enums\FacebookEnum;
use VitesseCms\Facebook\Services\FacebookService;
use VitesseCms\Form\Interfaces\AbstractFormInterface;

class SocialShareListener
{
    private $facebookService;

    public function __construct(FacebookService $facebookService)
    {
        $this->facebookService = $facebookService;
    }

    public function buildItemFormElement(Event $event, AbstractFormInterface $form, AbstractCollection $data = null): void
    {
        $form->addToggle('%FACEBOOK_SHARE_ITEM%', FacebookEnum::SHARE_ITEM);
    }

    public function beforeItemSave(Event $event, Item $item, Datafield $datafield): void
    {
        if ($item->getBool(FacebookEnum::SHARE_ITEM)) :
            $this->facebookService->postLink('Hello world', 'http://nu.nl');

            die();
        endif;
    }
}