<?php


namespace Drupal\evsy_newsletter_transport\Service\vkontakt;


interface VkontaktInterface {
    public function sendMessage($text);
    public function getUpdates();
}
