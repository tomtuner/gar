<?php

/**
 * Description of SolrSearchUrl
 *
 * @author Nikesh Hajari
 */

namespace Solr\Url;

class SolrSearchUrl
{
    
    private $solrUrlParameters; //rename to solrUrlSearchParameters
    
    private $defaultQueryValues;
    
    public function __construct()
    {
        $this->solrUrlParameters = array();
    }
    
    public function setDefaultQueryValues(array $defaultQueryValues)
    {
        $this->defaultQueryValues = $defaultQueryValues;
    }
    
    /**
     * Import Query String
     * 
     * @param type $solrQueryString
     */
    public function importQueryString($solrQueryString)
    {
        $this->solrQueryString = $solrQueryString;
        $this->queryStringToArray($solrQueryString);
    }
    
    /**
     * Query String To Array Conversion Function
     */
    private function queryStringToArray($solrQueryString)
    {

        //if there is no URL exit the method
        if(empty($solrQueryString))
        {
            return false;
        }

        //split the URL by & seperator
        $query = explode('&', $solrQueryString);

        $params = array();

        //loop over each parameter set
        foreach($query as $param)
        {
            //create a mapping
            list($name, $value) = explode('=', $param);

            //if value is in the array
            if(array_key_exists($name, $params))
            {
                //add array to make multidimensional ir it is not an array
                if(!is_array($params[$name]))
                {
                    //add the current key
                    $params[$name] = array(urldecode($params[$name]));
                }

                //add the value if it is an array
                if(is_array($params[$name]))
                {
                    $params[$name][] = urldecode($value);
                }
            } 
            else
            {
                //add param
                $params[$name] = urldecode($value);
            }
        }

        //If the input arrays have the same string keys, then the later value for that key will overwrite the previous one
        //Query String Values Should Always Take Precedence
        $mergedArrays = array_merge($this->solrUrlParameters, $params);
        $this->solrUrlParameters = $this->uniqueMultiDimensionalArray($mergedArrays);
    }
    
    /**
     * Get Solr Parameters
     * 
     * Returns Multi-Dimensional Array of Solr Parameters
     * @return array
     */
    public function getSolrParameters()
    {
        return $this->uniqueMultiDimensionalArray($this->solrUrlParameters);
    }
    
    public function setQuery($q)
    {
        $this->solrUrlParameters['q'] = $q;
    }
    
    public function getQuery()
    {
        return $this->getParameter('q', '*:*');
    }
    
    public function setSort($sort)
    {
        $this->solrUrlParameters['sort'] = $sort;
    }
    
    public function getSort()
    {
        $sort = $this->getParameter('sort');

        if(!is_null($sort) == true)
        {
            $sortParam = explode(" ", $this->getParameter('sort'));
                         
            $sortField = $sortParam[0];
            $sortDirection = $sortParam[1];

            return array($sortField => $sortDirection);
        }
        
        return array('score' => 'desc');
    }
    
    public function setStart($start)
    {
        $this->solrUrlParameters['start'] = $start;
    }
    
    public function getStart()
    {
        return $this->getParameter('start', 0);
    }
    
    public function setRows($rows)
    {
        $this->solrUrlParameters['rows'] = $rows;
    }
    
    public function getRows()
    {
        return $this->getParameter('rows', 10);
    }
    
    public function getFilterQueries()
    {
        return $this->getParameterCollection('fq', array());
    }
    
    public function addFilterQuery($filterQuery)
    {
        $this->addParameterToCollection('fq', $filterQuery);
    }
    
    public function getSolrSearchUrlParameters()
    {
        return $this->uniqueMultiDimensionalArray($this->solrUrlParameters);
    }
    
    public function setPage($page)
    {
        $this->solrUrlParameters['page'] = $page;
    }
    
    public function getPage()
    {
        return $this->getParameter('page', 1);
    }
    
    /**
     * Get Solr Search Url
     * 
     * Returns Url Encoded Query String
     * 
     * @return string
     */
    public function getSolrSearchUrl()
    {
        //create url encoded string with ampersand as the seperator
        $buildURL = http_build_query($this->getSolrSearchUrlParameters(), '', '&');

        //replace %5B0%5D = [0] which is appended in front of some parameters with just an equal sign
        $formattedURL = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=',
                $buildURL);

        //return formatted url
        return $formattedURL;
    }
    
    private function getParameter($key, $defaultReturnValue = NULL)
    {
        if(array_key_exists($key, $this->solrUrlParameters))
        {
            return $this->solrUrlParameters[$key];
        }
        
        return $defaultReturnValue;
    }
    
    private function addParameterToCollection($key, $value)
    {
        //if value is in the array
        if(array_key_exists($key, $this->solrUrlParameters))
        {
            //add array to make multidimensional ir it is not an array
            if(!is_array($this->solrUrlParameters[$key]))
            {
                //add the current key
                $this->solrUrlParameters[$key] = array($this->solrUrlParameters[$key]);
            }

            //add the value if it is an array
            if(is_array($this->solrUrlParameters[$key]))
            {
                $this->solrUrlParameters[$key][] = $value;
            }
        } 
        else
        {
            //add param
            $this->solrUrlParameters[$key] = $value;
        }
    }
    
    private function getParameterCollection($key, $defaultReturnValue = NULL)
    {
       if(array_key_exists($key, $this->solrUrlParameters))
       {
           if(!is_array($this->solrUrlParameters[$key]))
           {
               return array($this->solrUrlParameters[$key]);
           }
           
           return $this->solrUrlParameters[$key];
       }
       
       return $defaultReturnValue;
    }
    
    private function uniqueMultiDimensionalArray($array)
    {
        $result = array_map("unserialize", array_unique(array_map("serialize", $array)));

        foreach ($result as $key => $value)
        {
          if ( is_array($value) )
          {
            $result[$key] = $this->uniqueMultiDimensionalArray($value);
          }
        }

        return $result;
    }
    
    
}

?>
