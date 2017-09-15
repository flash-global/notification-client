<?php
namespace Fei\Service\Notification\Client\Entity\Alert;

/**
 * Class Email
 *
 * @package Fei\Service\Notification\Client\Entity\Alert
 */
class Email extends AbstractAlert
{
    /** @var string */
    protected $email;

    /** @var string */
    protected $subject;

    /** @var string */
    protected $content;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set Content
     *
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get Subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set Subject
     *
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return 'email';
    }
}
