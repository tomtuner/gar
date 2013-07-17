<?php

/**
 * Description of AbstractServiceEntity
 *
 * @author Nikesh Hajari
 */

namespace AppCore\Service\Entity;

abstract class AbstractServiceEntity implements \AppCore\Service\Entity\iServiceEntity
{

    /**
     * HTTP Request Params
     * 
     * @var \Zend\Http\Request 
     */
    protected $requestParams;

    /**
     * Class Default Constructor
     * 
     * In the controller the following can be passed in: 
     * 
     * $request->getRequest()->getPost()
     * $request->getRequest()->getQuery()
     * 
     * @param \Zend\Stdlib\Parameters $requestParams ($fieldName => $fieldValue)
     */
    public function __construct(\Zend\Stdlib\Parameters $requestParams)
    {
        $this->requestParams = $requestParams;
    }

    /**
     * Does Property Exist
     * 
     * @param string $offset
     * @return null 
     */
    public function doesPropertyExist($offset)
    {
        return isset($this->requestParams[$offset]);
    }

    /**
     * Get Property
     * 
     * @param string $offset
     * @return string|null 
     */
    public function getProperty($offset)
    {
        if($this->doesPropertyExist($offset))
    	{
    		if(is_string($this->requestParams[$offset]))
    		{
	    		return stripslashes($this->requestParams[$offset]);
    		}
    		
    		return $this->requestParams[$offset];
    	}
    	
    	return null;
    }
    
    /**
     * Get Shibboleth Service Entity
     * 
     * @return \AppCore\Shared\Service\Entity\ShibbolethServiceEntity Shibboleth Service Entity
     */
    public function getShibbolethServiceEntity()
    {
        return new \AppCore\Shared\Service\Entity\ShibbolethServiceEntity();
    }
    
    /**
     * Get Uploaded Files
     * 
     * By default PHP splits up the file information into
     * a multi-dimensional array like this which makes it 
     * difficult to process a multi-file upload. This function
     * will re-arrange the array and return the uploaded file information
     * 
     * Zend 2.1 is reported to have File Upload Support
     * <pre>
     * Array
     *      (
     *          [attachment] => Array
     *             (
     *                   [name] => Array
     *                       (
     *                           [0] => Art_Request_v1.pdf
     *                           [1] => Imagine_RIT_ERD_4_27_2012.pdf
     *                       )
     *
     *                        [type] => Array
     *                            (
     *                                [0] => application/pdf
     *                                [1] => application/pdf
     *                            )
     *
     *                        [tmp_name] => Array
     *                            (
     *                                [0] => C:\Windows\Temp\php8B55.tmp
     *                                [1] => C:\Windows\Temp\php8BB4.tmp
     *                            )
     *
     *                        [error] => Array
     *                            (
     *                                [0] => 0
     *                                [1] => 0
     *                            )
     *
     *                        [size] => Array
     *                            (
     *                                [0] => 179090
     *                                [1] => 201734
     *                            )
     *
     *                   )
     *
     *            )
     * </pre>
     * @return array Uploaded File Information
     */
    public function getUploadedFiles()
    {
        $newFiles = array(); 
        foreach($_FILES as $fieldname => $fieldvalue) 
            foreach($fieldvalue as $paramname => $paramvalue) 
                foreach((array)$paramvalue as $index => $value) 
                    $newFiles[$fieldname][$index][$paramname] = $value; 
        
        return $newFiles; 
        
    }

}

?>
