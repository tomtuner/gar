<?php

/**
 * Description of SolrClient
 *
 * @author Nikesh Hajari
 */

namespace Solr;

class SolrClient
{

    /**
     * Solr Path
     * 
     * @var string 
     */
    private $solrPath;
    
    /**
     * Solr Port
     * 
     * @var string 
     */
    private $solrPort;
            
    /**
     * Solr Hostname
     * 
     * @var string 
     */
    private $solrHost;
    
    /**
     * Class Default Constructor
     * 
     * @param string $host Solr Host
     * @param string $port Solr Port
     * @param string $path Solr Path
     */
    public function __construct($solrHost, $solrPort, $solrPath)
    {
        $this->solrHost = $solrHost;
        $this->solrPort = $solrPort;
        $this->solrPath = $solrPath;
    }
    
    /**
     * Get Solr Client
     * 
     * @return \Solarium\Client
     */
    public function getSolrClient()
    {
        $c = new \Solarium\Client($this->getConfig());
        return $c;
    }

    /**
     * Get Solr Host
     * 
     * @return string
     */
    public function getSolrHost()
    {
        return $this->solrHost;
    }

    /**
     * Get Solr Port
     * 
     * @return string
     */
    public function getSolrPort()
    {
        return $this->solrPort;
    }

    /**
     * Get Solr Path
     * 
     * @return string
     */
    public function getSolrPath()
    {
        return $this->solrPath;
    }

    /**
     * Get Solr Config
     * 
     * @return array
     */
    private function getConfig()
    {
        $config = array(
            'endpoint' => array(
                'localhost' => array(
                    'host' => $this->solrHost,
                    'port' => $this->solrPort,
                    'path' => $this->solrPath,
                )
            )
        );
        
        return $config;
    }

}

?>
