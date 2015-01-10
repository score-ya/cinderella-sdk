<?php

namespace ScoreYa\Cinderella\Template;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class TemplateClient extends Client
{
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
