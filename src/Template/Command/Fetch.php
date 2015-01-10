<?php

namespace ScoreYa\Cinderella\Template\Command;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Description\OperationInterface;

/**
 * @author Alexander Miehe <thelex@beamscore.com>
 */
class Fetch extends OperationCommand
{
    private $templateVariables;

    /**
     * remove the template name from the parameters
     *
     * @param array              $parameters
     * @param OperationInterface $operation
     */
    public function __construct($parameters = array(), OperationInterface $operation = null)
    {
        parent::__construct($parameters, $operation);
        $this->templateVariables = $parameters;
        unset($this->templateVariables['name']);
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
