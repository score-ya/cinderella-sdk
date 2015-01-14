<?php

namespace ScoreYa\Cinderella\SDK\Template\Command;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Description\OperationInterface;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class Fetch extends OperationCommand
{
    const TEMPLATE_VARIABLES = 'template.variables';

    private $templateVariables = array();

    /**
     * remove the template name from the parameters
     *
     * @param array                   $parameters
     * @param null|OperationInterface $operation
     */
    public function __construct($parameters = array(), OperationInterface $operation = null)
    {
        parent::__construct($parameters, $operation);
        if (isset($parameters[self::TEMPLATE_VARIABLES]) === true) {
            $this->templateVariables = $parameters[self::TEMPLATE_VARIABLES];
        }
    }

    /**
     * add the template variables to the query part
     *
     * @return \Guzzle\Http\Message\RequestInterface
     */
    public function prepare()
    {
        $request = parent::prepare();

        $url = $request->getUrl(true);

        $query = $url->getQuery();
        $query->merge($this->templateVariables);
        $request->setUrl($url);

        return $request;
    }

    /**
     * always return as result the body of the response
     */
    protected function process()
    {
        $this->result = $this->getResponse()->getBody(true);
    }
}
