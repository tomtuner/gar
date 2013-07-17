<?php

/**
 * Description of SolrUrlHelper
 *
 * @author Nikesh Hajari
 */

namespace Search\View\Helper;

use Zend\View\Helper\AbstractHelper;

class SolrUrl extends AbstractHelper
{

    private $solrUrl;
    
    public function  __construct(\Solr\Url\SolrUrl $solrUrl)
    {
        $this->solrUrl = $solrUrl;
    }
    
    public function __invoke()
    {
        //$this->solrUrl->addQueryString($_SERVER['QUERY_STRING']);
        //return clone $this->solrUrl;
        $sU = new \Solr\Url\SolrUrl();
        $sU->addQueryString($_SERVER['QUERY_STRING']);
        return $sU;
    }
    
}

?>
