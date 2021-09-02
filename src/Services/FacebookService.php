<?php declare(strict_types=1);

namespace VitesseCms\Facebook\Services;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use VitesseCms\Log\Services\LogService;

class FacebookService
{
    /**
     * @var Facebook
     */
    private $facebook;

    /**
     * @var LogService
     */
    private $log;

    public function __construct(
        Facebook $facebook,
        LogService $logService,
        string $baseUrl
    ) {
        $this->facebook = $facebook;
        $this->log = $logService;
        $this->loginCallbackUrl = $baseUrl.'facebook/index/logincallback';
    }

    public function postLink(string $message, string $link): bool
    {
        $this->setAccessToken();
        try {
            $response = $this->facebook->post('/me/feed', ['link' => $link, 'message' => $message]);
        } catch(FacebookResponseException $e) {
            $this->log->message('Graph returned an error: ' . $e->getMessage());
            var_dump('Graph returned an error: ' . $e->getMessage());
            die();
            return false;
        } catch(FacebookSDKException $e) {
            $this->log->message('Facebook SDK returned an error: ' . $e->getMessage());
            var_dump('Facebook SDK returned an error: ' . $e->getMessage());
            die();
            return false;
        }

        $graphNode = $response->getGraphNode();
        var_dump($graphNode);
        die();
    }

    private function setAccessToken(): void
    {
        $this->facebook->setDefaultAccessToken('EAAqGDreKGX8BALAJ8ZCCKOGZAx5Vi1XboLZAdkAFtZClwoKnUPt04elAkbkIl8PjxQtzyJZBYAjaZA2NNVwGlolKOZA9sxLqVZBBEXbIb3OqZAk68U24ZAKNLLLmoIcDEflD1s3ZBuBZBFvLATGdoIZAvzovZCi5ZA6ApEQiuAdZANfAnHXTU0hDqWsQQbACdm9pr8lcLYoZBQM8AJDNcWAZDZD');

        //$helper = $this->facebook->getRedirectLoginHelper();
        //$loginUrl = $helper->getLoginUrl($this->loginCallbackUrl);
        //header('Location: '.$loginUrl);
        //exit;

        /*try {
            $accessToken = $helper->getAccessToken();
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        var_dump($accessToken);
        die();*/
    }
}