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
    //private $facebookService;

    public function __construct()
    {
        //$this->facebookService = $facebookService;
    }

    public function buildItemFormElement(Event $event, AbstractFormInterface $form, Item $item = null): void
    {
        if ($item !== null) :
            $form->addHtml('<a
                href="http://www.facebook.com/share.php?u='.$form->url->getBaseUri().$item->getSlug().'&quote='.$this->getTextFromItem($item).'"
                target="_blank"
                class="btn btn-success offset-lg-3"
            >%FACEBOOK_SHARE_ITEM%</a>');
        endif;
    }

    private function getTextFromItem(Item $item): string
    {
        $text = '';
        if ($item->has('introtext')):
            $text = $item->_('introtext');
        endif;

        if (empty(trim($text)) && $item->has('bodytext')):
            $text = $item->_('bodytext');
        endif;

        $text = $item->getNameField().' : '.trim(strip_tags($text));
        $textChunks = str_split($text, 400);
        if(count($textChunks) > 1 ):
            $textChunks[0] .= '...';
        endif;

        return $text;
    }

    /*public function beforeItemSave(Event $event, Item $item, Datafield $datafield): void
    {
        if ($item->getBool(FacebookEnum::SHARE_ITEM)) :
            $this->facebookService->postLink('Hello world', 'http://nu.nl');

            die();
        endif;
    }*/
}