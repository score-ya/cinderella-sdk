<?php

namespace ScoreYa\Cinderella\SDK\Tests\Template\Command;

use Guzzle\Http\Message\Response;
use Guzzle\Tests\GuzzleTestCase;
use ScoreYa\Cinderella\SDK\Template\TemplateClient;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 *
 * @covers ScoreYa\Cinderella\SDK\Template\Command\Fetch
 */
class FetchTest extends GuzzleTestCase
{
    /**
     * @test
     */
    public function prepareUrl()
    {
        /** @var TemplateClient $client */
        $client = $this->getServiceBuilder()->get('template');

        $command = $client->getCommand('fetch', array(
            'name' => 'template_name',
            'first'    => 'replacement_content',
        ));
        $request = $command->prepare();
        $this->assertContains('apikey', $request->getUrl());
        $this->assertContains('test_api_key', $request->getUrl());
        $this->assertContains('template_name', $request->getUrl());
        $this->assertContains('replacement_content', $request->getUrl());
        $this->assertCount(2, $request->getUrl(true)->getQuery());
    }

    /**
     * @test
     */
    public function execute()
    {
        /** @var TemplateClient $client */
        $client = $this->getServiceBuilder()->get('template');

        $command = $client->getCommand('fetch', array(
            'name' => 'template_name',
            'first'    => 'replacement_content',
        ));
        $this->setMockResponse($client, array(
            new Response(200, null, 'template content'),
        ));
        $this->assertEquals('template content', $command->execute());
    }

    /**
     * @expectedException \Guzzle\Service\Exception\ValidationException
     * @expectedExceptionMessage Validation errors: [name] is required
     * @test
     */
    public function throwExceptionIfNoTemplateNameIsSet()
    {
        /** @var TemplateClient $client */
        $client = $this->getServiceBuilder()->get('template');

        $command = $client->getCommand('fetch', array(
            'first'    => 'replacement_content',
        ));
        $request = $command->prepare();
    }
}
