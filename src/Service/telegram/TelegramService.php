<?php

namespace Drupal\evsy_newsletter_transport\Service\telegram;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Psr\Log\LoggerInterface;
use Telegram\Bot\Api as TelegramApi;

/**
 *
 */
class TelegramService implements TelegramServiceInterface {

    use StringTranslationTrait;

    /**
     *
     * @var \Drupal\Core\Logger\LoggerChannelInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger) {

        $this->logger = $logger;
    }

    public function getApi(TelegramConfigInterface $config) {
        $telegram = new TelegramApi($config->getBotKey());
        return new Telegram($telegram, $config, $this->logger);
    }

}
