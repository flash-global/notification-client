<?php
namespace Fei\Service\Notification\Client\Entity;

use Fei\Entity\AbstractEntity;

/**
 * Class Notification
 *
 * @package Fei\Service\Notification\Entity
 */
class Notification extends AbstractEntity
{
    const TYPE_INFO = 1;
    const TYPE_WARNING = 2;

    const STATUS_READ = 1;
    const STATUS_ACKNOWLEDGED = 2;

    /** @var integer */
    protected $id;

    /** @var string */
    protected $origin;

    /**
     * Represent the Connect username of the user
     *
     * @var string
     */
    protected $recipient;

    /** @var string */
    protected $event;

    /** @var string */
    protected $message;

    /** @var integer */
    protected $type;

    /** @var \DateTime */
    protected $createdAt;

    /** @var integer */
    protected $status = 0;

    /** @var Notification */
    protected $parentNotificationId;

    /** @var string */
    protected $context = [];

    /** @var string */
    protected $action;

    public function __construct($input = [])
    {
        parent::__construct($input);

        if (empty($input['createdAt'])) {
            $this->setCreatedAt(new \DateTime());
        }
    }

    /**
     * Get Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get Origin
     *
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set Origin
     *
     * @param string $origin
     *
     * @return $this
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * Get Recipient
     *
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set Recipient
     *
     * @param string $recipient
     *
     * @return $this
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * Get Event
     *
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set Event
     *
     * @param string $event
     *
     * @return $this
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Get Message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get Type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set Type
     *
     * @param int $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get CreatedAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set CreatedAt
     *
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        if (is_string($createdAt)) {
            $createdAt = new \DateTime($createdAt);
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get ParentNotificationId
     *
     * @return Notification
     */
    public function getParentNotificationId()
    {
        return $this->parentNotificationId;
    }

    /**
     * Set ParentNotificationId
     *
     * @param Notification $parentNotificationId
     *
     * @return $this
     */
    public function setParentNotificationId($parentNotificationId)
    {
        $this->parentNotificationId = $parentNotificationId;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntityCollection()
    {
        return 'notifications';
    }

    /**
     * @inheritdoc
     */
    public function setContext($context, $value = null)
    {
        if ($value === null && is_array($context)) {
            $this->context = $context;

            return $this;
        }

        $this->context[$context] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getContext($context = null, $default = null)
    {
        if (null === $context) {
            return $this->context;
        }

        return isset($this->context[$context]) ? $this->context[$context] : $default;
    }

    /**
     * Get Action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set Action
     *
     * @param $action
     * @return $this
     */
    public function setAction($action)
    {
        if (is_array($action)) {
            $action = json_encode($action);
        }

        $this->action = $action;

        return $this;
    }
}
