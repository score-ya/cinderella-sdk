<?php

namespace ScoreYa\Cinderella\SDK\Template;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
interface TemplateClientInterface
{
    /**
     * @param string $name
     * @param array  $parameters
     * @param string $format
     *
     * @return mixed
     */
    public function fetch($name, $parameters, $format = 'html');
}
