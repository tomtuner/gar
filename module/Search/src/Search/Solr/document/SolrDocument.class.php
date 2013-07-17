<?php

/**
 * Solr Document
 *
 * This class is responsible for representing
 * a Solr Document (read-only)
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 */

namespace Solr\Document;

use Solr\Document\iSolrDocument;

class SolrDocument implements iSolrDocument
{

    /**
     * Solr Document: $solrDocument
     *
     * This property holds a reference to a Solr Document object
     * from the Solr Response
     *
     * @access private
     * @var object Solr Document
     */
    private $solrDocument;

    /**
     * Solr Document: Class Default Constructor
     *
     * This method is responsible for constructing the class
     * in order to access Solr Document data
     *
     * @access public
     * @param object $solrRawDocument Solr Raw Document
     * @return void
     */
    public function __construct($solrRawDocument)
    {
        //store Solr Document
        $this->solrDocument = $solrRawDocument;
    }

    /**
     * @see iSolrDocument
     */
    public function __get($fieldName)
    {
        if(is_string($this->solrDocument->{$fieldName}))
        {
            //return htmlspecialchars($this->solrDocument->{$fieldName}, ENT_HTML5, 'UTF-8', false);
        }

        return $this->solrDocument->{$fieldName};
        
       //FIXME: Return NULL
    }

    /**
     * @see iSolrDocument
     */
    public function __set($fieldName, $fieldValue)
    {
        //throw exception if you try to write to SolrDocument
        throw new SolrException('SOLR_READ_ONLY', null);
    }

}

?>