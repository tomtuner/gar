<?php

/**
 * Description of FileUploader
 *
 * @author Nikesh Hajari
 */

namespace AppFileUpload;

use AppFileUpload\Exception\FileUploadException;

class FileUploader
{

    /**
     * Collection of Files To Upload
     * @var array array(key => file information)
     */
    private $fileCollection;
    
    /*
     * Allowed File Extensions
     * @var array 
     */
    private $allowedExtensions = array('jpg', 'jpeg', 'gif', 'png', 
                                       'tiff', 'pdf', 'psd', 'docx', 
                                       'doc', 'ppt', 'pptx', 'xls', 'xlsx');
    
    /**
     * File Path To Upload
     * @var string 
     */
    private $filePathToUpload;

    /**
     * Class Default Constructor
     */
    public function __construct($filePathToUpload)
    {
        $this->fileCollection = array();
        $this->filePathToUpload = $filePathToUpload;
    }

    /**
     * Add New File For Upload
     * @param \AppFileUpload\File $file 
     */
    public function addFile(\AppFileUpload\File $file)
    {
        //validate file type
        $this->isValidFileExtension($file->getUploadedFileName());
        
        //check to see that file was uploaded
        $this->isFileUploaded($file->getTemporaryFileName());
        
        //then add to collection
        $this->fileCollection[] = $file;
    }
    
    /**
     * Rollback File Operations
     * 
     * Deletes Any File Moved
     * @return void 
     */
    public function rollBack()
    {
        foreach($this->fileCollection as $file)
        {
            //check to see if file exists
            if(file_exists($this->filePathToUpload . $file->getFileName()))
            {
                unlink($this->filePathToUpload . $file->getFileName());
            }
        }
    }
    
    /**
     * Save and Move Files
     * 
     * Checks for valid file extension and
     * ensures there was an actual file uploaded before
     * moving it
     * 
     * @param string $uploadPath Location To Upload File
     * @return boolean True if successful
     */
    public function commit()
    {
        foreach($this->fileCollection as $file)
        {
            //upload file
            $this->uploadFile($file->getTemporaryFileName(), $file->getFileName(), $this->filePathToUpload);
        }
        
        return true;
    }
    
    /**
     * Is Valid File Extension
     * 
     * @param string $fileName
     * @throws \AppCore\Exception\FileUploadException
     * @return void
     */
    private function isValidFileExtension($fileName)
    {
        $fileExt = substr(strrchr($fileName, '.'), 1);
        if(!in_array($fileExt, $this->allowedExtensions))
        {
            throw new FileUploadException($fileName . ' is a blocked file type');
        }
    }
    
    /**
     * Upload File
     * 
     * @param string $uploadPath
     * @throws \AppCore\Exception\FileUploadException
     * @return void
     */
    private function uploadFile($temporaryFileName, $actualFileName, $uploadPath)
    {
        if(!move_uploaded_file($temporaryFileName, $uploadPath . $actualFileName))
        {
            throw new FileUploadException('Error moving file: ' . $actualFileName);
        }
    }
    
    /**
     * Is File Uploaded
     * 
     * @param string $temporaryFileName
     * @throws \AppCore\Exception\FileUploadException 
     * @return void
     */
    private function isFileUploaded($temporaryFileName)
    {
        if(!is_uploaded_file($temporaryFileName))
        {
            throw new FileUploadException('File was not uploaded successfully');
        }
    }
    
    /**
     * Get Max Upload File Size
     * 
     * Get Max File Upload Size Setting
     * 
     * @return integer
     */
    public function getMaxUploadFileSize()
    {
        $max_upload = (int)(ini_get('upload_max_filesize'));
        $max_post = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        return $upload_mb = min($max_upload, $max_post, $memory_limit);
    }
        
}

?>