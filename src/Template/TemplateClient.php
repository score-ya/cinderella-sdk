<?php

namespace ScoreYa\Cinderella\SDK\Template;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use ScoreYa\Cinderella\SDK\Common\Service\ApiKeyClientInterface;
use ScoreYa\Cinderella\SDK\Template\Command\Fetch;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class TemplateClient extends Client implements ApiKeyClientInterface, TemplateClientInterface
{
    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->setDefaultOption('query/apikey', $apiKey);
    }

    /**
     * @param string $name
     * @param array  $parameters
     * @param string $format
     *
     * @return string
     */
    public function fetch($name, $parameters, $format = 'html')
    {
        return $this
            ->getCommand('fetch', array('name' => $name,'format' => $format, Fetch::TEMPLATE_VARIABLES => $parameters))
            ->getResult();
    }


    /**
     * @param array $config
     *
     * @return TemplateClient
     *
     * @codeCoverageIgnore Test is not need because the command tests only work if this method works.
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
