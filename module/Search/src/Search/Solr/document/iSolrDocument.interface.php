<?php

/**
 * iSolrDocument
 *
 * This interface is responsible for
 * binding together SolrInputDocument
 * and SolrHighlightedDocumentDecorator
 * to ensure they have the same methods
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 */

namespace Solr\Document;

interface iSolrDocument
{

    /**
     * iSolrDocument: __get
     *
     * This method is responsible for fetching a property
     * from using the get magic method
     *
     * @access public
     * @param string $fieldName Solr Field Name
     * @return mixed Return type is usually array, string or null
     */
    public function __set($fieldName, $fieldValue);

    /**
     * iSolrDocument: __set
     *
     * This method is responsible for setting a new property
     * on a Solr Document, but is disabled. This
     * method will throw an error if trying to write to a Solr 
     * Document variant. Use SolrInputDocument if you want to write/create
     * a new Solr Document
     *
     * @access public
     * @param string $fieldName Field Name
     * @param string $fieldValue Facet Value
     * @return SolrException
     */
    public function __get($fieldName);
}

?>