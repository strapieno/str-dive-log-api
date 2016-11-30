<?php
namespace Strapieno\DiveLog\Api\V1\Hydrator;

use Matryoshka\Model\Hydrator\Strategy\DateTimeStrategy;
use Strapieno\Utils\Hydrator\DateHystoryHydrator;

/**
 * Class DiveLogHydrator
 */
class DiveLogHydrator extends DateHystoryHydrator
{
    public function __construct($underscoreSeparatedKeys = true)
    {
        parent::__construct($underscoreSeparatedKeys);
        $this->addStrategy('date_when', new DateTimeStrategy('Y-m-d'));
    }
}