<?php

/**
 * Solr Pager Factory
 *
 * This class is responsible for returning
 * a new Zend Pager and assists for Solr
 * Paging functions
 *
 * @author Nikesh Hajari/Jon Ng
 * @package solr-data
 */
class SolrPagerFactory
{

    /**
     * Solr Pager Factory: Class Default Contructor
     * 
     * This class should never be instantiated directly
     * 
     * @access private
     * @return void
     */
    private function __construct()
    {
        //prevent direct construction of object	
    }

    /**
     * Solr Pager Factory: Get Pager
     * 
     * Initialize and return Zend Paginator
     * 
     * @access public
     * @static
     * @param integer $pageNumber Current Pager Number
     * @param integer $maxItemsPerPage Max Number of Results per Page
     * @param integer $resultCount Total Result Set Size
     * @return Zend_Paginator Zend Paginator Instance
     */
    public static function getPager($pageNumber, $maxItemsPerPage, $resultCount)
    {
        //construct pager with result count only
        $paginator = new \Zend\Paginator(new \Zend\Paginator\Adapter\Null($resultCount));

        //set the maximum number of items to display per page
        $paginator->setItemCountPerPage($maxItemsPerPage);

        //set the current page number
        $paginator->setCurrentPageNumber($pageNumber);

        //return pager
        return $paginator;
    }

}

?>