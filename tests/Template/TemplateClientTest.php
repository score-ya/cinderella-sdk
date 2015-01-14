<?php

namespace ScoreYa\Cinderella\SDK\Tests\Template;

use Guzzle\Http\Message\Response;
use Guzzle\Tests\GuzzleTestCase;
use ScoreYa\Cinderella\SDK\Template\TemplateClient;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 * 
 * @covers ScoreYa\Cinderella\SDK\Template\TemplateClient
 * @covers ScoreYa\Cinderella\SDK\Template\Command\Fetch
 */
class TemplateClientTest extends GuzzleTestCase
{
    /**
     * @test
     */
    public function execute()
    {
        /** @var TemplateClient $client */
        $client = $this->getServiceBuilder()->get('template');

        $this->setMockResponse(
            $client,
            array(
                new Response(200, null, 'template content'),
            )
        );

        $template = $client->fetch('template_name', array('first' => 'replacement_content'));

        $this->assertEquals('template content', $template);
    }
}
