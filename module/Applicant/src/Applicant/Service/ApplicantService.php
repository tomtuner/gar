<?php

/**
 * Description of ApplicantService
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Service;

use AppCore\Exception\ServiceException;
use AppCore\Service\EventHookType;

class ApplicantService extends \AppCore\Service\AbstractService
{

    /**
     * Add New Applicant
     * 
     * @return string Applicant Id
     * @throws ServiceException 
     */
    public function add()
    {
        //file uploader
        $fileUploader = new \AppFileUpload\FileUploader(__DIR__ . '/../../../../../uploads/');
        
        try
        {
            //applicant service entity
            $applicantServiceEntity = $this->getDataEntity('Applicant\Service\Entity\ApplicantServiceEntity');

            //pre-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::PRE,
                    $this, array('serviceEntity' => $applicantServiceEntity));

            //create applicant
            $applicantId = $this->getModel('Applicant\Model\ApplicantModel')->create($applicantServiceEntity);
			
            //process applicant attachments
            foreach($applicantServiceEntity->getUploadedFiles() as $attachments)
            {
                //double loop is required because $artRequestServiceEntity->getUploadedFiles() returns
                //a multi-dimensional array
                foreach($attachments as $attachment)
                {
                    $file = new \AppFileUpload\File($attachment);
					$fileName = $applicantServiceEntity->getLastName() . '_' . $applicantServiceEntity->getFirstName() . '_RESUME.' . $file->getFileExtension();
					$file->setFileName($fileName);
                    $fileUploader->addFile($file);
                }                
            }
                                            
            //save files
            $fileUploader->commit();
            
            //post-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::POST,
                    $this,
                    array('serviceEntity' => $applicantServiceEntity, 'result' => $applicantId));

            //applicant id
            return $applicantId;
        } catch(\Exception $e)
        {
            //roll back file upload
            $fileUploader->rollBack();
            throw new ServiceException('Error Adding Applicant', $e);
        }
    }
    
    /**
     * Get Application Status
     * 
     * @return boolean
     * @throws ServiceException
     */
    public function getApplicationStatus()
    {
        try
        {
            //applicant service entity
            $applicantServiceEntity = $this->getDataEntity('Applicant\Service\Entity\ApplicantServiceEntity');

            //pre-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::PRE,
                    $this, array('serviceEntity' => $applicantServiceEntity));

            //application status
            $hasSubmittedApplication = $this->getModel('Applicant\Model\ApplicantModel')->hasSubmittedApplication($applicantServiceEntity);
            
            //post-method hook
            $this->getEventManager()->trigger(__FUNCTION__ . EventHookType::POST,
                    $this,
                    array('serviceEntity' => $applicantServiceEntity, 'result' => $hasSubmittedApplication));

            //applicant status
            return $hasSubmittedApplication;
        } catch(\Exception $e)
        {
            throw new ServiceException('Error Getting Applicant Status', $e);
        }
    }
    
}

?>