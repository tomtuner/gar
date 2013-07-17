<?php

/**
 * Description of File
 *
 * @author Nikesh Hajari
 */

namespace AppFileUpload;

use AppFileUpload\Exception\FileUploadException;

class File
{
    /**
     * Uploaded File Information
     * @var array
     */
    private $file;
	
	/**
	 * Filename
	 */
	private $fileName;
    
    /**
     * File Upload Error Codes
     * @var array
     */
    private $fileUploadErrors = array(
                                       '0' => 'UPLOAD_ERR_OK', 
                                       '1' => 'UPLOAD_ERR_INI_SIZE', 
                                       '2' => 'UPLOAD_ERR_FORM_SIZE',
                                       '3' => 'UPLOAD_ERR_PARTIAL',
                                       '4' => 'UPLOAD_ERR_NO_FILE',
                                       '6' => 'UPLOAD_ERR_NO_TMP_DIR',
                                       '7' => 'UPLOAD_ERR_CANT_WRITE',
                                       '8' => 'UPLOAD_ERR_EXTENSION'
                                      );
    
    /**
     * Class Default Constructor
     * @param array $file 
     */
    public function __construct($file)
    {
        $this->file = $file;
    }
    
    /**
     * Get Uploaded File Name
     * @return string File Name
     */
    public function getUploadedFileName()
    {
       return $this->file['name'];
    }
    
    /**
     *  Get File Type
     *  @return string File Type
     */
    public function getFileType()
    {
        return $this->file['type'];
    }
    
    /**
     * Get Temporary File Name
     * @return string File Name 
     */
    public function getTemporaryFileName()
    {
        return $this->file['tmp_name'];        
    }
    
    /**
     * Get Error
     * @return string Error Code 
     */
    public function getError()
    {
        return $this->fileUploadErrors[$this->file['error']];
    }
    
    /**
     * Get File Size
     * @return string File Size 
     */
    public function getFileSize()
    {
        return $this->file['size'];    
    }
	
	/**
	 * Set File Name
	 * @return void
	 */
	public function setFileName($fileName)
	{
		$this->fileName = $fileName;
	}
	
	/**
	 * Get File Name
	 * @return string
	 */
	public function getFileName()
	{
		if(empty($this->fileName))
		{
            throw new FileUploadException('You must set a file name using the File Class method setFileName!');
		}
		
		return $this->fileName;
	}
	
	/**
	 * Get File Extension
	 * @return string
	 */
	public function getFileExtension()
	{
		$ext = pathinfo($this->getUploadedFileName(), PATHINFO_EXTENSION);
		return $ext;
	}
    
}

?>