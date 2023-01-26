<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners\Controllers;

use Phalcon\Events\Event;
use Phalcon\Events\Manager;
use VitesseCms\Content\Models\Item;
use VitesseCms\Core\Services\ViewService;
use VitesseCms\Mustache\DTO\RenderTemplateDTO;
use VitesseCms\Mustache\Enum\ViewEnum;
use VitesseCms\Setting\Services\SettingService;

class AbstractControllerListener
{
    /**
     * @var Manager
     */
    private $eventManager;

    /**
     * @var SettingService
     */
    private $settings;

    public function __construct(Manager $eventManager, SettingService $settingService)
    {
        $this->eventManager = $eventManager;
        $this->settings = $settingService;
    }

    public function prepareHtmlView(Event $event, ViewService $viewService): void
    {
        if ($viewService->hasCurrentItem()) :
            $opengraph = $this->eventManager->fire(
                ViewEnum::RENDER_TEMPLATE_EVENT,
                new RenderTemplateDTO('opengraph','', $this->getParams($viewService->getCurrentItem()))
            );
            $viewService->set('opengraph', $opengraph);
        endif;
    }

    protected function getParams(Item $item): array
    {
        $params = [
            'title' => $item->getNameField(),
            'type' => 'article',
            'url' => $item->getSlug()
        ];

        if ($item->_('image')) :
            $params['image'] = $item->_('image');
        endif;

        if ($item->_('price_sale')) :
            $params['type'] = 'product';
            $params['amount'] = $item->_('price_sale');
            $params['currency'] = $this->settings->get('SHOP_CURRENCY_ISO');
            $params['availability'] = 'instock';
        endif;

        if ($this->settings->has('SEO_META_DESCRIPTION')) :
            $params['description'] = $this->settings->get('SEO_META_DESCRIPTION');
        endif;

        if (trim(strip_tags($item->_('introtext')))) :
            $params['description'] = strip_tags($item->_('introtext'));
        endif;

        return $params;
    }
}
