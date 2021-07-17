<?php

namespace Drupal\evsy_newsletter_transport\Service\telegram;

/**
 *
 */
class TelegramConfig implements TelegramConfigInterface {

    const PARAM_TEXT = 'text';

    const PARAM_CHAT_ID = 'chat_id';

    const PARAM_PARSE_MODE = 'parse_mode';


    private $config = [];

    public function __construct($config) {
        $this->config = $config + $this->getDefault();
    }

    public function getBotKey() {
        return $this->config['bot_key'];
    }

    protected function getDefault() {
        return [
            self::PARAM_PARSE_MODE => 'Markdown',
        ];
    }

    public function sendMessage($text) {
        return [
            self::PARAM_CHAT_ID => $this->config[self::PARAM_CHAT_ID],
            self::PARAM_TEXT => $text,
            self::PARAM_PARSE_MODE => $this->config[self::PARAM_PARSE_MODE],
        ];
    }
    public function getUpdates() {
        return [];
    }

}
