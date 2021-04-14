<?php


namespace Drupal\evsy_newsletter_transport\Plugin\NewsletterTransport;


use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\evsy_newsletter\Plugin\NewsletterTransportPluginBase;
use Drupal\evsy_newsletter\Plugin\NewsletterTransportPluginInterface;
use Drupal\evsy_newsletter_transport\Service\TelegramConfig;
use Drupal\evsy_newsletter_transport\Service\TelegramInterface;
use Drupal\evsy_newsletter_transport\Service\TelegramServiceInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Telegram\Bot\Objects\Update;

/**
 * Class DrupalLog
 *
 * @NewsletterTransport(
 *   id = "telegram",
 *   label = "Telegram"
 * )
 */
class Telegram extends NewsletterTransportPluginBase implements NewsletterTransportPluginInterface {

    use StringTranslationTrait;

    /** @var TelegramInterface */
    private $telegramApi;

    /** @var TelegramServiceInterface */
    private $telegramService;

    public function __construct(array $configuration,
                                $plugin_id,
                                $plugin_definition,
                                EntityTypeManagerInterface $entityTypeManager,
                                TelegramServiceInterface $telegramService
    ) {
        parent::__construct($configuration, $plugin_id, $plugin_definition, $entityTypeManager);
        $this->telegramService = $telegramService;
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
            $configuration,
            $plugin_id,
            $plugin_definition,
            $container->get('entity_type.manager'),
            $container->get('evsy_newsletter_transport.telegram.service')
        );
    }

    public function getTelegramApi() {
        if (empty($this->telegramApi)) {
            $config = $this->getConfig() + $this->configuration;
            $config = new TelegramConfig($config);
            $this->telegramApi = $this->telegramService->getApi($config);
        }
        return $this->telegramApi;
    }

    public function send($text) {
        $this->getTelegramApi()->sendMessage($text);
    }

    public function getConfigForm($config, $form, FormStateInterface $form_state, $ajax = NULL) {
        $elements['bot_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Bot key'),
            '#default_value' => $config['bot_key'],
        ];

        return $elements;
    }

    public function getConfigDefault() {
        return ['bot_key' => ''];
    }

    protected function extractChatOptions($response) {
        $options = [];

        foreach ($response as $item) {
            /** @var $item Update */
            $chat = $item->get('my_chat_member')->get('chat');
            $options[$chat->get('id')] = $chat->get('title');
        }
        return $options;
    }


    public function getNewsletterConfigForm($config, $form, FormStateInterface $form_state, $ajax = NULL) {

        $elements['chat_id'] = [
            '#title' => $this->t('Chat ID'),
            '#default_value' => $config['chat_id'],
        ];

        $updates = $this->getTelegramApi()->getUpdates();


        if (!empty($updates)) {
            $elements['chat_id'] +=[
                '#type' => 'select',
                '#options' => $this->extractChatOptions($updates),
            ];
        } else {
            $elements['chat_id'] +=[
                '#type' => 'textfield',
            ];
        }

        return $elements;
    }

    public function getNewsletterConfigDefault() {
        return ['chat_id' => NULL];
    }

    public function getFormConfig($config, $form, FormStateInterface $form_state) {
        $elements['bot_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Bot key'),
            '#default_value' => $config['bot_key'],
        ];

        return $elements;
    }
}
