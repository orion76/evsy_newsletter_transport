<?php

namespace Drupal\evsy_newsletter_transport\Service\vkontakt;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Psr\Log\LoggerInterface;
use VK\Client\VKApiClient as VkApi;

/**
 *
 */
class Vkontakt implements VkontaktInterface {

    use StringTranslationTrait;

    /**
     *
     * @var \Drupal\Core\Config\Config
     */
    protected $vkConfig;

    /**
     *
     * @var \Drupal\Core\Logger\LoggerChannelInterface
     */
    protected $logger;

    /** @var VkApi */
    protected $vk;

    /** @var VkontaktConfigInterface */
    protected $request;

    public function __construct(VkApi $vk, VkontaktConfigInterface $request, LoggerInterface $logger) {

        $this->vk = $vk;
        $this->request = $request;
        $this->logger = $logger;
    }

    public function sendMessage($text) {
        return $this->vk->messages()->send($this->request->getAccessToken(),$this->request->groupPost($text));
    }

    public function getUpdates() {
        return $this->vk->getUpdates($this->request->getUpdates());
    }
    
}
