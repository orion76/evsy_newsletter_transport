<?php


namespace Drupal\evsy_newsletter_transport\Service\vkontakt;


interface VkontaktApiFactoryInterface {
    public function getApi(VkontaktConfigInterface $config) ;
}
