<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Services;

use VitesseCms\Log\Services\LogService;

class AdminServices implements AdminServicesInterface
{
    /**
     * @var LogService
     */
    public $log;

    public $setting;

    public function __onConstruct()
    {
        $this->log = new LogService();
    }
}