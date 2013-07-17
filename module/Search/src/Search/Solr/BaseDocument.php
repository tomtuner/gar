<?php

/**
 * Description of BaseDocument
 *
 * @author Nikesh Hajari
 */

namespace Solr;

class BaseDocument
{

    /**
     * Solrium Result Document
     * 
     * @var \Solarium\QueryType\Select\Result\Document 
     */
    protected $document;

    /**
     * Class Default Constructor
     * 
     * @param \Solarium\QueryType\Select\Result\Document $document
     */
    public function __construct(\Solarium\QueryType\Select\Result\Document $document)
    {
        $this->document = $document;
    }

    /**
     * Get Property
     * 
     * @param string $offset
     * @return string|null 
     * @fixme Server Magic Quotes - Remove Strip Slashes
     */
    public function getProperty($offset)
    {
        if(is_string($this->document->{$offset}))
        {
            return htmlspecialchars($this->document->{$offset}, ENT_HTML5, 'UTF-8', false);
        }

        return $this->document->{$offset};
    }

}

?>