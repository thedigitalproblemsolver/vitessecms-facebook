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

    /**
     * @var bool
     */
    private $isAdmin;

    public function __construct(string $vendorBaseDir, bool $hasPixel, bool $isAdmin)
    {
        $this->vendorBaseDir = $vendorBaseDir;
        $this->hasPixel = $hasPixel;
        $this->isAdmin = $isAdmin;
    }

    public function load(Event $event, AssetsService $assetsService): void
    {
        if ($this->hasPixel && !$this->isAdmin) :
            $assetsService->addInlineJs(
                file_get_contents($this->vendorBaseDir . 'facebook/src/Resources/js/facebook.js')
            );
        endif;
    }
}