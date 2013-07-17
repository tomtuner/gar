<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Client
 *
 * @author Nikesh Hajari
 */

namespace AppHTTP\Client;

class WebServiceClient
{
    
    private $client;
    
    private $parameters;
    
    private $httpRequestType;
    
    public function __construct(\Zend\Http\Client $client)
    {
        $this->client = $client;
        $this->parameters =  array();
    }
    
    public function addParameter($parameterName, $parameterValue)
    {
        $this->parameters[$parameterName] = $parameterValue;
    }
    
    public function setHttpRequestType($httpRequestType)
    {
        $this->httpRequestType = $httpRequestType;
    }
    
    public function setUri($uri)
    {
        $this->client->setUri($uri);
    }
    
    private function setParameters()
    {
        
        switch($this->httpRequestType)
        {
            case 'POST':
                $this->client->setParameterPost($this->parameters);
                break;
            case 'GET' :
                $this->client->setParameterGet($this->parameters);
                break;
        }
        
    }
    
    public function doRequest()
    {
        $this->setParameters();
        $this->client->setMethod($this->httpRequestType);
        $response = $this->client->send();
        
        return $response->getContent();
    }
    
}

?>
