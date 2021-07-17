<?php

namespace Drupal\evsy_newsletter_transport\Service\vkontakt;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Psr\Log\LoggerInterface;
use VK\Client\VKApiClient as VkApi;

/**
 *
 */
class VkontaktApiFactory implements VkontaktApiFactoryInterface {

    use StringTranslationTrait;

    /**
     *
     * @var \Drupal\Core\Logger\LoggerChannelInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger) {

        $this->logger = $logger;
    }

    public function getApi(VkontaktConfigInterface $config) {
        $vkApi = new VkApi();
        return new Vkontakt($vkApi, $config, $this->logger);
    }

}
