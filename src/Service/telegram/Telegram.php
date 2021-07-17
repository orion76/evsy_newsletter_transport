<?php

namespace Drupal\evsy_newsletter_transport\Service\telegram;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Psr\Log\LoggerInterface;
use Telegram\Bot\Api as TelegramApi;

/**
 *
 */
class Telegram implements TelegramInterface {

    use StringTranslationTrait;

    /**
     *
     * @var \Drupal\Core\Config\Config
     */
    protected $telegramConfig;

    /**
     *
     * @var \Drupal\Core\Logger\LoggerChannelInterface
     */
    protected $logger;

    /** @var TelegramApi */
    protected $telegram;

    /** @var TelegramConfigInterface */
    protected $request;

    public function __construct(TelegramApi $telegram, TelegramConfigInterface $request, LoggerInterface $logger) {

        $this->telegram = $telegram;
        $this->request = $request;
        $this->logger = $logger;
    }


    public function sendMessage($text) {
        return $this->telegram->sendMessage($this->request->sendMessage($text));
    }

    public function getUpdates() {
        return $this->telegram->getUpdates($this->request->getUpdates());
    }
    
}
