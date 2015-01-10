<?php

namespace ScoreYa\Cinderella\Common;

use Guzzle\Http\Client;
use Guzzle\Service\Builder\ServiceBuilder;
use ScoreYa\Cinderella\Common\Service\Builder\ServiceBuilderLoader;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class ClientBuilder extends ServiceBuilder
{
    private static $apiKey;

    public static function build($apiKey)
    {
        self::$apiKey = $apiKey;
        static::$cachedFactory = new ServiceBuilderLoader();

        return parent::factory(__DIR__.'/Resources/clients.json');
    }

    public function get($name, $throwAway = false)
    {
        if (isset($this->builderConfig[$name])
            && isset($this->builderConfig[$name]['params'][Client::REQUEST_OPTIONS]['query']['apikey'])) {
            $this->builderConfig[$name]['params'][Client::REQUEST_OPTIONS]['query']['apikey'] = self::$apiKey;
        }

        return parent::get($name, $throwAway);
    }
}
