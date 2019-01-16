<?php

namespace Fei\Service\Notification\Client;

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\RequestDescriptor;
use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Entity\Alert\Sms\Message;
use Fei\Service\Notification\Transformer\NotificationTransformer;
use Fei\Service\Notification\Entity\Notification;

/**
 * Class Notifier
 *
 * @package Fei\Service\Notification\Client
 */
class Notifier extends AbstractApiClient implements NotifierInterface
{
    const API_PATH_INFO = '/api/notifications';
    const API_ALERT_PATH_INFO = '/api/alerts';

    /**
     * @inheritdoc
     */
    public function fetchAll(SearchBuilder $searchBuilder, $perPage = 1)
    {
        $params = urlencode(json_encode($searchBuilder->getParams()));
        $perPage = urlencode($perPage);

        $request = (new RequestDescriptor())
            ->setMethod('GET')
            ->setUrl(
                $this->buildUrl(
                    self::API_PATH_INFO . '/fetch/' . $perPage . '?criteria=' . $params
                )
            );

        return $this->send($request)->getData();
    }

    /**
     * @inheritdoc
     */
    public function delete($id)
    {
        $request = (new RequestDescriptor())
            ->setMethod('DELETE')
            ->setUrl($this->buildUrl(self::API_PATH_INFO . '/' . urlencode($id)));

        $response = $this->send($request);

        return $response->getData();
    }

    /**
     * @inheritdoc
     */
    public function fetchOne($id)
    {
        $request = (new RequestDescriptor())
            ->setMethod('GET')
            ->setUrl($this->buildUrl(self::API_PATH_INFO . '/' . urlencode($id)));

        $response = $this->send($request);
        $notification = new Notification($response->getData());

        return $notification;
    }

    /**
     * @inheritdoc
     */
    public function notify($notifications)
    {
        $notifications = is_array($notifications) ? $notifications : [$notifications];
        $data = array_map(function ($value) {
            if ($value instanceof Notification) {
                return (new NotificationTransformer)->transform($value);
            } elseif (is_array($value)) {
                return $value;
            }

            return [];
        }, $notifications);

        $request = (new RequestDescriptor())
            ->setMethod('POST')
            ->setUrl($this->buildUrl(self::API_PATH_INFO . '/create'));
        $request->setBodyParams([
            'notifications' => json_encode($data)
        ]);

        $response = $this->send($request);

        $result = json_decode($response->getBody(), true);

        return $result['created'];
    }

    /**
     * @inheritdoc
     */
    public function markAsRead(SearchBuilder $searchBuilder)
    {

        $request = (new RequestDescriptor())
            ->setMethod('PUT')
            ->setUrl($this->buildUrl(self::API_PATH_INFO . '/markAsRead'));
        $request->setBodyParams(['notifications' => json_encode($searchBuilder->getParams())]);

        $response = $this->send($request);
        $dataResponse = json_decode($response->getBody(), true);

        return $this->getCollection($dataResponse['updated']);
    }

    /**
     * @inheritdoc
     */
    public function markAsAcknowledged(SearchBuilder $searchBuilder)
    {
        $request = (new RequestDescriptor())
            ->setMethod('PUT')
            ->setUrl($this->buildUrl(self::API_PATH_INFO . '/markAsAcknowledged'));
        $request->setBodyParams(['notifications' => json_encode($searchBuilder->getParams())]);

        $response = $this->send($request);
        $dataResponse = json_decode($response->getBody(), true);

        return $this->getCollection($dataResponse['updated']);
    }

    /**
     * @inheritdoc
     */
    public function alert($alert)
    {
        $request = (new RequestDescriptor())
            ->setMethod('POST')
            ->setUrl($this->buildUrl(self::API_ALERT_PATH_INFO . '/create'));

        $alert = $alert->toArray();

        if (array_key_exists('messages', $alert)) {
            $alert['messages'] = array_map(function (Message $message) {
                return $message->toArray();
            }, $alert['messages']);
        }

        $alert['notification'] = $alert['notification']->getId();

        $request->setBodyParams(['alerts' => json_encode([$alert])]);

        $response = $this->send($request);
        $dataResponse = json_decode($response->getBody(), true);

        return $dataResponse;
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function getCollection($data = [])
    {
        return array_map(function ($value) {
            return new Notification($value);
        }, $data);
    }
}
