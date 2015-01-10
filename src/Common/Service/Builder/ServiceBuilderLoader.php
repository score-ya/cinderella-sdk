<?php

namespace ScoreYa\Cinderella\Common\Service\Builder;

use Guzzle\Service\Builder\ServiceBuilderLoader as BaseServiceBuilderLoader;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class ServiceBuilderLoader extends BaseServiceBuilderLoader
{
    protected function mergeData(array $a, array $b)
    {
        if (!isset($b['services'])) {
            return $b + $a;
        }

        return parent::mergeData($a, $b);
    }
}
