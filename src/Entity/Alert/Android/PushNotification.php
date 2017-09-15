<?php


namespace Fei\Service\Notification\Client\Entity\Alert\Android;

/**
 * Class PushNotification
 *
 * https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
 *
 * @package Fei\Service\Notification\Client\Entity\Alert\Android
 */
class PushNotification extends AbstractAndroid
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $androidChannelId;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var string
     */
    protected $sound;

    /**
     * @var string
     */
    protected $tag;

    /**
     * format #rrggbb
     *
     * @var string
     */
    protected $color;

    /**
     * @var string
     */
    protected $clickAction;

    /**
     * @var string
     */
    protected $bodyLocKey;

    /**
     * format JSON array as String
     *
     * @var array
     */
    protected $bodyLocArgs;

    /**
     * @var string
     */
    protected $titleLocKey;

    /**
     * format JSON array as String
     *
     * @var array
     */
    protected $titleLocArgs;

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Title
     *
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get Body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set Body
     *
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get AndroidChannelId
     *
     * @return string
     */
    public function getAndroidChannelId()
    {
        return $this->androidChannelId;
    }

    /**
     * Set AndroidChannelId
     *
     * @param $androidChannelId
     * @return $this
     */
    public function setAndroidChannelId($androidChannelId)
    {
        $this->androidChannelId = $androidChannelId;
        return $this;
    }

    /**
     * Get Icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set Icon
     *
     * @param $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Get Sound
     *
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Set Sound
     *
     * @param $sound
     * @return $this
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
        return $this;
    }

    /**
     * Get Tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set Tag
     *
     * @param $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * Get Color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set Color
     *
     * @param $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Get ClickAction
     *
     * @return string
     */
    public function getClickAction()
    {
        return $this->clickAction;
    }

    /**
     * Set ClickAction
     *
     * @param $clickAction
     * @return $this
     */
    public function setClickAction($clickAction)
    {
        $this->clickAction = $clickAction;
        return $this;
    }

    /**
     * Get BodyLocKey
     *
     * @return string
     */
    public function getBodyLocKey()
    {
        return $this->bodyLocKey;
    }

    /**
     * Set BodyLocKey
     *
     * @param $bodyLocKey
     * @return $this
     */
    public function setBodyLocKey($bodyLocKey)
    {
        $this->bodyLocKey = $bodyLocKey;
        return $this;
    }

    /**
     * Get BodyLocArgs
     *
     * @return array
     */
    public function getBodyLocArgs()
    {
        return $this->bodyLocArgs;
    }

    /**
     * Set BodyLocArgs
     *
     * @param array $bodyLocArgs
     * @return $this
     */
    public function setBodyLocArgs(array $bodyLocArgs)
    {
        $this->bodyLocArgs = $bodyLocArgs;
        return $this;
    }

    /**
     * Get TitleLocKey
     * @return string
     */
    public function getTitleLocKey()
    {
        return $this->titleLocKey;
    }

    /**
     * Set TitleLocKey
     *
     * @param string $titleLocKey
     *
     * @return $this
     */
    public function setTitleLocKey($titleLocKey)
    {
        $this->titleLocKey = $titleLocKey;
        return $this;
    }

    /**
     * Get TitleLocArgs
     *
     * @return array
     */
    public function getTitleLocArgs()
    {
        return $this->titleLocArgs;
    }

    /**
     * Set TitleLocArgs
     *
     * @param array $titleLocArgs
     *
     * @return $this
     */
    public function setTitleLocArgs(array $titleLocArgs)
    {
        $this->titleLocArgs = $titleLocArgs;
        return $this;
    }

    /**
     * Build an array which contains all value possible for a notification fcm :
     * https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
     *
     * @return array
     */
    public function buildArray()
    {
        $data = [];
        $vars = get_object_vars($this);

        foreach ($vars as $var => $value) {
            if (!empty($value)) {
                $attr = $this->toSnakeCase($var);
                $data[$attr] = $value;
            }
        }

        return $data;
    }
}
