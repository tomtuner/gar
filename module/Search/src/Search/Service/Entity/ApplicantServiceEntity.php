<?php

/**
 * Description of ApplicantServiceEntity
 *
 * @author Nikesh Hajari
 */

namespace Search\Service\Entity;

class ApplicantServiceEntity extends \AppCore\Service\Entity\AbstractServiceEntity
{

    /**
     * Get Applicant Id
     * 
     * @return string|null
     */
    public function getApplicantId()
    {
        return $this->getProperty('applicant_id');
    }
    
}

?>