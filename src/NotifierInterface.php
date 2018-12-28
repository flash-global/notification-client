<?php
namespace Fei\Service\Notification\Client;

use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Entity\Notification;

/**
 * Interface NotifierInterface
 *
 * @package Fei\Service\Notification\Client
 */
interface NotifierInterface
{

    /**
     * @param SearchBuilder $searchBuilder
     *
     * @return Notification[]
     */
    public function fetchAll(SearchBuilder $searchBuilder);

    /**
     * @param integer $id
     *
     * @return Notification
     */
    public function fetchOne($id);

    /**
     * @param $notifications
     *
     * @return Notification[]
     */
    public function notify($notifications);


    /**
     * Mark all as read array of id or notifications
     *
     * @param SearchBuilder $searchBuilder
     *
     * @return Notification[]
     */
    public function markAsRead(SearchBuilder $searchBuilder);

    /**
     * Mark a notification as acknowledged
     *
     * @param SearchBuilder $searchBuilder
     *
     * @return Notification[]
     */
    public function markAsAcknowledged(SearchBuilder $searchBuilder);


    /**
     * Add an alert to the notification liked in the alert
     *
     * @param AbstractAlert|AbstractAlert[] $alert
     *
     * @return AbstractAlert|AbstractAlert[]
     */
    public function alert($alert);
}
