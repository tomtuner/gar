<?php

/**
 * Solr Facet
 *
 * This class is responsible for representing a SolrFacet
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 * @subpackage facet
 * @abstract
 */

namespace Solr\Facet;

use Solr\Facet\iSolrFacet;

abstract class SolrFacet implements iSolrFacet
{

    /**
     * Solr Facet: $solrFacetCollection
     *
     * This property holds an object containing
     * a collection of facets from the Original Solr Response.
     * This object is a map in which the name of the
     * facet is the key and the facet count is the
     * value
     *
     * @access protected
     * @property object An object map of key/value facet pairs
     */
    protected $solrFacetCollection;

    /**
     * Solr Facet: $facetFieldName
     *
     * This property holds a reference to the name of 
     * Solr facet field
     *
     * @access protected
     * @property string Facet field name
     */
    protected $facetFieldName;

    /**
     * Solr Facet: Class Default Constructor
     *
     * This method is responsible for constructing the class
     * in order to access SolrFacet data
     *
     * @access public
     * @param string $facetFieldName Solr facet field name
     * @param object $solrFacet A object of key/value pair of Solr facets
     * @return void
     */
    public function __construct($facetFieldName, $solrFacetCollection)
    {
        //assign solrFacet property
        $this->solrFacetCollection = $solrFacetCollection;

        //assign facetFieldName
        $this->facetFieldName = $facetFieldName;
    }

    /**
     * @see iSolrFacet
     */
    public function getFacetFieldName()
    {
        //output facet field name
        return $this->facetFieldName;
    }

    /**
     * Solr Facet: Get Facet Data
     *
     * This method is responsible for returning facet data
     * a collection of facets from the original Solr Response.
     * This object is a map in which the name of the
     * facet is the key and the facet count is the
     * value
     *
     * @access public
     * @return object|null A key/value pair of Solr Facets or NULL if nothing
     */
    public function getFacetData()
    {
        //check to see if facet exists and return output
        return $this->solrFacetCollection;
    }

    /**
     * Solr Facet: Get Facet Size
     *
     * This method is responsible returning the number
     * of facet items for a Solr Facet
     *
     * @access public
     * @return int|null Number of facet items in a Solr facets or NULL if nothing
     */
    public function getFacetSize()
    {
        //get facet size by converting to array, checking to see if exists
        //and return output
        return sizeof($this->solrFacetCollection);
    }

    /**
     * Solr Facet: Is Facet Empty?
     *
     * This method is responsible for determining if a facet has
     * no facet items within it
     *
     * @access public
     * @return bool Returns TRUE if facet is empty, else FALSE
     */
    public function isFacetEmpty()
    {
        //do a integer comparision to get boolean output
        return $this->getFacetSize() == 0;
    }

}

?>