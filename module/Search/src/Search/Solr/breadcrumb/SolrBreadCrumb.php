<?php

/**
 * Description of SolrBreadCrumb
 *
 * @author Nikesh Hajari
 */

namespace Solr\BreadCrumb;

class SolrBreadCrumb
{

    public function __construct(\Solr\Url\SolrSearchUrl $solrUrl)
    {
        $this->solrUrl = $solrUrl;
    }

    public function getBreadCrumbs()
    {
        return $this->getFilterQueryBreadCrumbLink();
    }

    private function getFilterQueryText($fq)
    {
        //add +1/-1 to remove quotes
        $startQuote = stripos($fq, '"');
        $endQuote = strrpos($fq, '"');
        return str_replace('"', '', substr($fq, $startQuote, $endQuote));
    }

    public function getQueryBreadCrumbLink()
    {
        return array('"' . $this->solrUrl->getQuery() . '"' => 'q=' . $this->solrUrl->getQuery());
    }

    public function getFilterQueryBreadCrumbLink()
    {

        $links = array();

        $finalLinks = array();

        $fq = $this->solrUrl->getFilterQueries();

        if(isset($fq))
        {
            if(is_array($fq))
            {
                $reverseFq = array_reverse($this->solrUrl->getFilterQueries());
                foreach($reverseFq as $fq)
                {
                    $links[] = $fq;
                }
            } else
            {
                $links[] = $fq;
            }

            $reverseQueryFilters = array_reverse($links);


            $sort = $this->getSort();

            foreach($links as $link)
            {
                //if there is more than one link then we need to append the
                //other links to each other
                if(count($links) > 1)
                {

                    $recentFilterQuery = array_pop($reverseQueryFilters);
                    $finalLinks[$this->getFilterQueryText($link)] = "q=" . $this->solrUrl->getQuery() . str_replace("&fq=&fq=",
                                    "&fq=",
                                    "&fq=" . implode('&fq=',
                                            $reverseQueryFilters) . '&fq=' . $recentFilterQuery) . '&sort=' . $sort;
                }

                if(count($links) == 1)
                {
                    $finalLinks[$this->getFilterQueryText($link)] = "q=" . $this->solrUrl->getQuery() . "&fq=" . $reverseQueryFilters[0] . '&sort=' . $sort;
                }
            }
        }

        $finalLinks['"' . $this->solrUrl->getQuery() . '"'] = 'q=' . $this->solrUrl->getQuery() . '&sort=' . $sort;

        return array_reverse($finalLinks);
    }

    public function getSort()
    {
        $sortParam = $this->solrUrl->getSort();

        $sortField = key(array_slice($this->solrUrl->getSort(), -1, 1, TRUE));

        $sort = $sortField . ' ' . $sortParam[$sortField];

        return $sort;
    }

}

?>
