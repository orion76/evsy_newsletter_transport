<?php


namespace Drupal\evsy_newsletter_transport\Service\telegram;


interface TelegramServiceInterface {
    public function getApi(TelegramConfigInterface $config) ;
}
