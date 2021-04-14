<?php


namespace Drupal\evsy_newsletter_transport\Service;


interface TelegramServiceInterface {
    public function getApi(TelegramConfigInterface $config) ;
}
