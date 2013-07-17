<?php

/**
 * Solr Highlighted Document Decorator
 *
 * This class is a decorator class representing a
 * Solr highlighted document
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 * @subpackage highlight
 */

namespace Solr\Highlight;

use Solr\Document\iSolrDocument;

class SolrHighlightedDocumentDecorator implements iSolrDocument
{

    /**
     * Solr Highlighted Document Decorator: $solrDocument
     *
     * This property stores a Solr Document
     *
     * @access private
     * @var object A Solr Document
     */
    private $solrDocument;

    /**
     * Solr Highlighted Document Decorator: $solrHighlight
     *
     * This property stores a SolrHighlight object
     *
     * @access private
     * @var object SolrHighlight A Solr Highlight Object
     */
    private $solrHighlight;

    /**
     * Solr Highlighted Document Decorator: Class Default Constructor
     *
     * This method is responsible for constructing the class
     * in order to access a Solr Highlighted Document
     *
     * @access public
     * @param array|object $solrDocument A Raw Solr Document
     * @param object SolrHighlight A Solr Highlight Object
     * @return void
     */
    public function __construct($solrRawDocument, SolrHighlight $solrHighlight)
    {
        //assign solr document property
        $this->solrDocument = $solrRawDocument;

        //assign solr highlight property
        $this->solrHighlight = $solrHighlight;
    }

    /**
     * Solr Highlighted Document Decorator: __Get Magic Method
     *
     * This method is responsible for retrieving information
     * for a specific field from a Solr Document. This method performs
     * the decoration on a Solr Document to make it a Solr Highlighted
     * document. A Solr highlighted document field has the option to be prefixed. An
     * example is highlight_<your fieldname from Solr>. The suffix must be the same
     * as the original field or create a seperate entry in SolrConfig for highlight fields
     * This has to be configured in both the in name of the field in the Solr Schema and 
     * in the SolrConfig.
     *
     * @see iSolrDocument
     * @todo Add an exception if the highlight prefix does not exist when trying to use it
     */
    public function __get($fieldName)
    {

        //cast highlight object to array
        $highlightMatches = $this->solrHighlight->getHighlights();
        
        if(array_key_exists($fieldName, $highlightMatches))
        {
            //strip all HTML content except for highlighted words
            $tags =  strip_tags($highlightMatches[$fieldName], '<em>');
            return $tags;
        }
    
        if(is_string($this->solrDocument->{$fieldName}))
        {
            //return htmlspecialchars(strip_tags($this->solrDocument->{$fieldName}), ENT_HTML5, 'UTF-8', false);
        }

        return $this->solrDocument->{$fieldName};
            
    }

    /**
     * @see iSolrDocument
     */
    public function __set($fieldName, $fieldValue)
    {

        //throw exception if someone tries to write to this object
        //you should never be able to modify a Solr Document external to the object
        throw new SolrException('SOLR_READ_ONLY', null);
    }

}

?>