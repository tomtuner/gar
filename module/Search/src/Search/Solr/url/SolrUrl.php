<?php

/**
 * Description of SolrUrl
 *
 * @author Nikesh Hajari
 */

namespace Solr\Url;

class SolrUrl
{

    /**
     * Solr Url Query String
     * @var string 
     */
    private $solrQueryString;
    
    /**
     * Solr Url Parameters
     * 
     * Multi-Dimensional Array
     * @var array 
     */
    private $solrUrlParameters;
    
    /**
     * Multi-Valued Search Url Parameters
     * 
     * @var array 
     */
    private $multiValuedParameters = array('fq');
    
    /**
     * Single Valued Search Url Parameters
     * 
     * @var array 
     */
    private $singleValuedParameters = array('q', 'sort', 'rows', 'start', 'page');

    /**
     * Class Default Constructor
     */
    public function __construct()
    {
        $this->solrUrlParameters = array();
    }
    
    /**
     * From Query String
     * 
     * @param type $solrQueryString
     */
    public function addQueryString($solrQueryString)
    {
        $this->solrQueryString = $solrQueryString;
        $this->queryStringToArray();
    }

    /**
     * Query String To Array Conversion Function
     */
    private function queryStringToArray()
    {
        $url = $this->solrQueryString;

        //if there is no URL exit the method
        if(empty($url))
        {
            return false;
        }

        //split the URL by & seperator
        $query = explode('&', $url);

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

        $this->solrUrlParameters = array_merge($params, $this->solrUrlParameters);
    }
    
    /**
     * Get Solr Parameters
     * 
     * Returns Multi-Dimensional Array of Solr Parameters
     * @return array
     */
    public function getSolrParameters()
    {
        //$u = array_map('unserialize', array_unique(arraymap('serialize', $this->solrUrlParameters)));
        return $this->uniqueMultiDimensionalArray($this->solrUrlParameters);
    }

    /**
     * Get Solr Url
     * 
     * Returns Url Encoded Query String
     * 
     * @return string
     */
    public function getSolrUrl()
    {
        //create url encoded string with ampersand as the seperator
        $buildURL = http_build_query($this->getSolrParameters(), '', '&');

        //replace %5B0%5D = [0] which is appended in front of some parameters with just an equal sign
        $formattedURL = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=',
                $buildURL);

        //return formatted url
        return $formattedURL;
    }

    /**
     * Add Url Parameter
     * 
     * @param string $key
     * @param string $value
     */
    public function addUrlParameter($key, $value)
    {    
        $multiValuedParams = array('fq'); //modify this
        
        //if value is in the array
        if(array_key_exists($key, $this->solrUrlParameters))
        {
            //add array to make multidimensional ir it is not an array
            if(!is_array($this->solrUrlParameters[$key]) && array_key_exists($key, $multiValuedParams))
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
    
    public function removeUrlParameter($key, $value = null)
    {
        //if value is in the array
        if(array_key_exists($key, $this->solrUrlParameters))
        {
            //add array to make multidimensional ir it is not an array
            if(!is_array($this->solrUrlParameters[$key]) || $value == NULL)
            {
                //add the current key
                unset($this->solrUrlParameters[$key]);
            }

            //add the value if it is an array
            if(is_array($this->solrUrlParameters[$key]) && $value == NULL)
            {
                $itemToRemoveKey = array_search($value, $this->solrUrlParameters[$key]);
                
                if($key != FALSE)
                {
                    unset($this->solrUrlParameters[$key][$itemToRemoveKey]);
                }
            }
            
        } 
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
    
   public function getUrlParameter($key)
   {
       if(array_key_exists($key, $this->solrUrlParameters))
       {
           return $this->solrUrlParameters[$key];
       }
       
       return NULL;
   }
   
   public function getQuery()
   {
       if(array_key_exists('q', $this->solrUrlParameters))
       {
           return $this->solrUrlParameters['q'];
       }
       
       return NULL;
   }
   
   public function getFilterQueries()
   {
       if(array_key_exists('fq', $this->solrUrlParameters))
       {
           if(!is_array($this->solrUrlParameters['fq']))
           {
               return array($this->solrUrlParameters['fq']);
           }
           
           return $this->solrUrlParameters['fq'];
       }
       
       return array(); //FIXME
   }
   
   public function getSort()
   {
       if(array_key_exists('sort', $this->solrUrlParameters))
       {
             $sortParam = explode(" ", $this->solrUrlParameters['sort']);
             
             $sortField = $sortParam[0];
             $sortDirection = $sortParam[1];
             
             return array($sortField => $sortDirection);
       }
       
       return array();
   }

}

?>
