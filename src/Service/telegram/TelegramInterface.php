<?php


namespace Drupal\evsy_newsletter_transport\Service\telegram;


interface TelegramInterface {
    public function sendMessage($text);
    public function getUpdates();
}
