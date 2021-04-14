<?php


namespace Drupal\evsy_newsletter_transport\Service;


interface TelegramConfigInterface {

    public function sendMessage($text);
    public function getUpdates();
    public function getBotKey();
}
