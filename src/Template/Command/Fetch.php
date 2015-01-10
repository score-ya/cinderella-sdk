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

    public function __construct($parameters = array(), OperationInterface $operation = null)
    {
        parent::__construct($parameters, $operation);
        $this->templateVariables = $parameters;
        unset($this->templateVariables['name']);
    }

    public function prepare()
    {
        $request = parent::prepare();

        $url = $request->getUrl(true);

        $query = $url->getQuery();
        $query->merge($this->templateVariables);
        $request->setUrl($url);

        return $request;
    }

    protected function process()
    {
        $this->result = $this->getResponse()->getBody(true);
    }
}
