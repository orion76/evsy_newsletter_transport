<?php


namespace Drupal\evsy_newsletter_transport\Service\vkontakt;


interface VkontaktConfigInterface {

    public function groupPost($text);
    public function getUpdates();
    public function getAccessToken();
}
