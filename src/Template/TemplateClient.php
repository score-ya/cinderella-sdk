<?php

namespace ScoreYa\Cinderella\SDK\Template;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use ScoreYa\Cinderella\SDK\Common\Service\ApiKeyClientInterface;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 *
 * @codeCoverageIgnore Test is not need because the command tests only work if this client works.
 */
class TemplateClient extends Client implements ApiKeyClientInterface
{
    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->setDefaultOption('query/apikey', $apiKey);
    }

    /**
     * @param array $config
     *
     * @return TemplateClient
     */
    public static function factory($config = array())
    {
        // Merge in default settings and validate the config
        $config = Collection::fromConfig($config);

        // Create a new Cinderella Template client
        $client = new self('', $config);

        $description = ServiceDescription::factory(__DIR__.'/Resources/template-1.0.json');
        $client->setDescription($description);

        return $client;
    }
}
