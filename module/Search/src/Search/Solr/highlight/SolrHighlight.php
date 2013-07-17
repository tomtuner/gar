<?php

/**
 * Solr Highlight
 *
 * This class is responsible for representing
 * Solr highlight matches for a document
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 * @subpackage highlight
 */

namespace Solr\Highlight;

class SolrHighlight
{

    /**
     * Solr Highlight: $highlights
     *
     * This property stores the an object array of highlights
     *
     * @access private
     * @var object|array An collection of highlights
     */
    private $highlights;

    /**
     * Solr Highlight: $documentID
     *
     * This property stores the document ID that the highlights
     * are associated with
     *
     * @access private
     * @var string Document ID of highlights
     */
    private $documentID;

    /**
     * Solr Highlight: Class Default Constructor
     *
     * This method is responsible for constructing the class
     * in order to access Solr Highlight data
     *
     * @access public
     * @param string $documentID Solr Document ID
     * @param object $highlights Solr Highlight matches from raw response returned from Solr
     * in the format of an object which is key/value pair. Key => Object Property, Value => Property Value
     * @return void
     */
    public function __construct($documentID, $highlights)
    {

        //assign document id property
        $this->documentID = $documentID;

        //assign highlights property
        $this->highlights = $highlights;
    }

    /**
     * Solr Highlight: Get Highlights
     *
     * This method is responsible for returning the
     * collection of key/value pair highlights
     *
     * @access public
     * @return object Solr Highlight matches from raw response returned from Solr
     * in the format of an object which is key/value pair. Key => Object Property, Value => Property Value
     */
    public function getHighlights()
    {
        $highlights = array();
        
        foreach($this->highlights as $fieldName => $highlight)
        {
            $highlights[$fieldName] = implode($highlight);
        }
        
        //output highlights
        return $highlights;
    }

    /**
     * Solr Highlight: Get Document ID
     *
     * This method is responsible for returning the
     * Solr document id
     *
     * @access public
     * @return string Solr document ID
     */
    public function getDocumentID()
    {
        //output document id
        return $this->documentID;
    }

}

?>