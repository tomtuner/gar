<?php

/**
 * Solr Facet Interface
 *
 * This class is an interface responsible for
 * representing a Solr Facet. This class
 * contains no methods and is used to ensure one 
 * facet type can't be confused with another. In 
 * addition, this class helps provide identity to 
 * a Solr Facet
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 * @subpackage facet
 */

namespace Solr\Facet;

interface iSolrFacet
{

    /**
     * iSolrFacet: Get Facet Field Name
     *
     * This method is responsible for returning the name
     * of the Solr facet field name
     *
     * @access public
     * @return string Solr Facet Name
     */
    public function getFacetFieldName();
    
}

?>