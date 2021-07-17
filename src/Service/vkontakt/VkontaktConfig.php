<?php

namespace Drupal\evsy_newsletter_transport\Service\vkontakt;

/**
 *
 */
class VkontaktConfig implements VkontaktConfigInterface {

    const PARAM_MESSAGE = 'message';

    const PARAM_OWNER_ID = 'owner_id';

    const PARAM_PARSE_MODE = 'parse_mode';


    private $config = [];

    public function __construct($config) {
        $this->config = $config + $this->getDefault();
    }

    public function getAccessToken() {
        return $this->config['bot_key'];
    }

    protected function getDefault() {
        return [
            self::PARAM_PARSE_MODE => 'Markdown',
        ];
    }

    /**
     * @param $text
     * $params
     *	 @var integer owner_id: User ID or community ID. Use a negative value to designate a community ID.
     * - @var boolean friends_only: '1' — post will be available to friends only, '0' — post will be available to all users (default)
     * - @var boolean from_group: For a community: '1' — post will be published by the community, '0' — post will be published by the user (default)
     * - @var string message: (Required if 'attachments' is not set.) Text of the post.
     * - @var array[string] attachments: (Required if 'message' is not set.) List of objects attached to the post, in the following format: "<owner_id>_<media_id>,<owner_id>_<media_id>", '' — Type of media attachment: 'photo' — photo, 'video' — video, 'audio' — audio, 'doc' — document, 'page' — wiki-page, 'note' — note, 'poll' — poll, 'album' — photo album, '<owner_id>' — ID of the media application owner. '<media_id>' — Media application ID. Example: "photo100172_166443618,photo66748_265827614", May contain a link to an external page to include in the post. Example: "photo66748_265827614,http://habrahabr.ru", "NOTE: If more than one link is being attached, an error will be thrown."
     * - @var string services: List of services or websites the update will be exported to, if the user has so requested. Sample values: 'twitter', 'facebook'.
     * - @var boolean signed: Only for posts in communities with 'from_group' set to '1': '1' — post will be signed with the name of the posting user, '0' — post will not be signed (default)
     * - @var integer publish_date: Publication date (in Unix time). If used, posting will be delayed until the set time.
     * - @var number lat: Geographical latitude of a check-in, in degrees (from -90 to 90).
     * - @var number long: Geographical longitude of a check-in, in degrees (from -180 to 180).
     * - @var integer place_id: ID of the location where the user was tagged.
     * - @var integer post_id: Post ID. Used for publishing of scheduled and suggested posts.
     * - @var string guid
     * - @var boolean mark_as_ads
     * - @var boolean close_comments
     * - @var boolean mute_notifications
     * @return array
     */
    public function groupPost($text) {
        return [
            self::PARAM_OWNER_ID => $this->config[self::PARAM_OWNER_ID],
            self::PARAM_MESSAGE => $text
        ];
    }
    public function getUpdates() {
        return [];
    }

}
