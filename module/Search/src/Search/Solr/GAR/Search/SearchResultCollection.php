<?php

/**
 * Description of SearchResultCollection
 *
 * @author Nikesh Hajari
 */

namespace Solr\GAR\Search;

use Solr\Highlight\SolrHighlightedDocumentDecorator;
use Solr\Highlight\SolrHighlight;

class SearchResultCollection
{
    
    /**
     * Search Result Collection from Solarium
     * 
     * @var \Solarium\QueryType\Select\Result\Result 
     */
    private $searchResultCollection;
   
    /**
     * Class Default Constructor
     * 
     * @param \Solarium\QueryType\Select\Result\Result $searchResultCollection
     */
    public function __construct(\Solarium\QueryType\Select\Result\Result $searchResultCollection)
    {
        $this->searchResultCollection = $searchResultCollection;
    }
    
    /**
     * Get Number of Documents Found
     * 
     * @return string
     */
    public function getNumberOfDocumentsFound()
    {
        return $this->searchResultCollection->getNumFound();
    }
    
    /**
     * Get Search Result Collection
     * 
     * @return array Collection of \Solr\GAR\Search\ResultDocument
     */
    public function getSearchResultCollection()
    {
        $searchResultCollection = array();
        
        $highlighting = $this->searchResultCollection->getHighlighting();
                
        foreach($this->searchResultCollection as $result)
        {
            $solrHighlight = new SolrHighlight($result->{'applicant_id'}, $highlighting->getResult($result->{'applicant_id'}));
            array_push($searchResultCollection, new SolrHighlightedDocumentDecorator($result, $solrHighlight));
        }
        
        return $searchResultCollection;
    }
    
}

?>
