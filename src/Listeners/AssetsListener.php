<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Listeners;

use Phalcon\Events\Event;
use VitesseCms\Media\Services\AssetsService;

class AssetsListener
{
    /**
     * @var string
     */
    private $vendorBaseDir;

    /**
     * @var bool
     */
    private $hasPixel;

    public function __construct(string $vendorBaseDir, bool $hasPixel)
    {
        $this->vendorBaseDir = $vendorBaseDir;
        $this->hasPixel = $hasPixel;
    }

    public function loadGeneric(Event $event, AssetsService $assetsService): void
    {
        if ($this->hasPixel) :
            $assetsService->addInlineJs(file_get_contents($this->vendorBaseDir . 'facebook/src/Resources/js/facebook.js'));
        endif;
    }
}