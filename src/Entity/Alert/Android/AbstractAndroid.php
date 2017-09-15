<?php

namespace Fei\Service\Notification\Client\Entity\Alert\Android;

use Fei\Entity\AbstractEntity;

/**
 * Class AbstractAndroid
 * @package Fei\Service\Notification\Client\Entity\Alert\Android
 */
abstract class AbstractAndroid extends AbstractEntity
{
    /**
     * @return mixed
     */
    abstract public function buildArray();
}
