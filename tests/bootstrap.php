<?php
/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
require dirname(__DIR__).'/vendor/autoload.php';

$serviceBuilder = \ScoreYa\Cinderella\Common\ClientBuilder::build('test_api_key');

\Guzzle\Tests\GuzzleTestCase::setServiceBuilder($serviceBuilder);
