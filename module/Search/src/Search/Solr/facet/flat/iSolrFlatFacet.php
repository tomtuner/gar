<?php

/**
 * Solr Flat Facet Interface
 *
 * This class is an interface responsible for
 * representing a Solr Flat Facet. This class
 * contains no methods and is used to ensure one 
 * facet type can't be confused with another. In 
 * addition, this class helps provide identity to 
 * a Solr Facet
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 * @subpackage flat
 * @see iSolrFacet
 */

namespace Solr\Facet;

use Solr\Facet\iSolrFacet;

interface iSolrFlatFacet extends iSolrFacet
{
    /**
     * Skeleton interface used to provide identity to a SolrFlatFacet
     */
}

?>