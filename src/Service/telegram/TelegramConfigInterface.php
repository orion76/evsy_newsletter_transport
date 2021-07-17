<?php


namespace Drupal\evsy_newsletter_transport\Service\telegram;


interface TelegramConfigInterface {

    public function sendMessage($text);
    public function getUpdates();
    public function getBotKey();
}
