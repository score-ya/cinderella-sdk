<?php

namespace ScoreYa\Cinderella\SDK\Common;

use Guzzle\Service\Builder\ServiceBuilder;
use Guzzle\Service\ClientInterface;
use ScoreYa\Cinderella\SDK\Common\Service\ApiKeyClientInterface;
use ScoreYa\Cinderella\SDK\Common\Service\Builder\ServiceBuilderLoader;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 *
 * @codeCoverageIgnore Test is not need because the command tests only work if this builder works, see tests/bootstrap.php.
 */
class ClientBuilder extends ServiceBuilder
{
    private static $apiKey;

    /**
     * @param string $apiKey
     *
     * @return \Guzzle\Service\Builder\ServiceBuilderInterface
     */
    public static function build($apiKey)
    {
        self::$apiKey          = $apiKey;
        static::$cachedFactory = new ServiceBuilderLoader();

        return parent::factory(__DIR__.'/Resources/clients.json');
    }

    /**
     * set the api key for api key clients
     *
     * @param string $name
     * @param bool   $throwAway
     *
     * @return ClientInterface
     */
    public function get($name, $throwAway = false)
    {
        $client = parent::get($name, $throwAway);

        if ($client instanceof ApiKeyClientInterface) {
            $client->setApiKey(self::$apiKey);
        }

        return $client;
    }
}
