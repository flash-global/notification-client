<?php
namespace Fei\Service\Notification\Client;

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\RequestDescriptor;
use Fei\ApiClient\ResponseDescriptor;
use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Transformer\NotificationTransformer;
use Fei\Service\Notification\Transformer\AlertTransformer;
use Fei\Service\Notification\Client\Exception\NotificationException;
use Fei\Service\Notification\Entity\Notification;
use Guzzle\Http\Exception\BadResponseException;
use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Alert\Rss;

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

        $response = $this->send($request);

        return $this->getCollection($response->getData());
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
	$request->setBodyParams(['alerts' => json_encode($alert)]);

	$response = $this->send($request);
        $dataResponse = json_decode($response->getBody(), true);
        return $dataResponse;
    }

    /**
     * {@inheritdoc}
     */
    public function send(RequestDescriptor $request, $flags = 0)
    {
        try {
            $response = $this->callSendInParent($request, $flags);

            if ($response instanceof ResponseDescriptor) {
                return $response;
            }
        } catch (\Exception $e) {
            $previous = $e->getPrevious();
            if ($previous instanceof BadResponseException) {
                $data = \json_decode($previous->getResponse()->getBody(true), true);
                if (isset($data['code']) && isset($data['error'])) {
                    throw new NotificationException($data['error'], $data['code'], $e);
                }
            }
            throw new NotificationException($e->getMessage(), $e->getCode(), $e);
        }
        return null;
    }

    /**
     * @param RequestDescriptor $request
     * @param int $flags
     * @return bool|ResponseDescriptor
     */
    protected function callSendInParent(RequestDescriptor $request, $flags)
    {
        return parent::send($request, $flags);
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
