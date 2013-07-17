<?php

/**
 * Description of ApplicantServiceEntity
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Service\Entity;

class ApplicantServiceEntity extends \AppCore\Service\Entity\AbstractServiceEntity
{

    /**
     * Get First Name
     * 
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->getProperty('first_name');
    }
    
    /**
     * Get Last Name
     * 
     * @return string|null
     */
    public function getLastName()
    {
        return $this->getProperty('last_name');
    }
    
    /**
     * Get E-mail Address
     * 
     * @return string|null
     */
    public function getEmailAddress()
    {
        return $this->getProperty('email_address');
    }
    
    /**
     * Get Telephone Number
     * 
     * @return string|null
     */
    public function getTelephoneNumber()
    {
        return $this->getProperty('telephone_number');
    }
    
    /**
     * Get Address One
     * 
     * @return string|null
     */
    public function getAddressOne()
    {
        return $this->getProperty('address_one');
    }
    
    /**
     * Get Address Two
     * 
     * @return string|null
     */
    public function getAddressTwo()
    {
        return $this->getProperty('address_two');
    }
    
    /**
     * get City
     * 
     * @return string|null
     */
    public function getCity()
    {
        return $this->getProperty('city');
    }
    
    /**
     * Get State Province Region
     * 
     * @return string|null
     */
    public function getStateProvinceRegion()
    {
        return $this->getProperty('state_province_region');
    }
    
    /**
     * Get Country
     * 
     * @return string|null
     */
    public function getCountry()
    {
        return $this->getProperty('country');
    }
    
    /**
     * Get Undergraduate Institution
     * 
     * @return string|null
     */
    public function getUndergraduateInstitution()
    {
        return $this->getProperty('undergraduate_institution');
    }
    
    /**
     * Get Graduate Institution
     * 
     * @return string|null
     */
    public function getGraduateInstitution()
    {
        return $this->getProperty('graduate_institution');
    }
    
    /**
     * Get Graduate Program
     * 
     * @return string|null
     */
    public function getGraduateProgram()
    {
        return $this->getProperty('graduate_program');
    }
    
    /**
     * Get Positions
     * 
     * @return array|null
     */
    public function getPositionIds()
    {
        return $this->getProperty('position_id');
    }
    
    /**
     * Get Reference One
     * 
     * @return string|null
     */
    public function getReferenceOne()
    {
        return $this->getProperty('reference_one');
    }
    
    /**
     * Get Reference Two
     * 
     * @return string|null
     */
    public function getReferenceTwo()
    {
        return $this->getProperty('reference_two');
    }
    
    /**
     * Get Reference Three
     * 
     * @return string|null
     */
    public function getReferenceThree()
    {
        return $this->getProperty('reference_three');
    }
    
    /**
     * Get Personal Qualities Question
     * 
     * @return string|null
     */
    public function getPersonalQualitiesQuestion()
    {
        return $this->getProperty('personal_qualities_question');
    }
    
    /**
     * Get Prior Experiences Question
     * 
     * @return string|null
     */
    public function getPriorExperiencesQuestion()
    {
        return $this->getProperty('prior_experiences_question');
    }
    
    /**
     * Get Resume Cover Letter Attachment File Name
     * 
     * @return array|null
     */
    public function getResumeCoverLetterAttachmentFileName()
    {
       $f = $this->getUploadedFiles();
	   $ext = pathinfo($f['resume_cover_letter_attachment'][0]['name'], PATHINFO_EXTENSION);
	   $fileName = $this->getLastName() . '_' . $this->getFirstName() . '_RESUME.' . $ext;
	   return $fileName;
    }
    
    /**
     * Get Zip Postal Code
     * 
     * @return string|null
     */
    public function getZipPostalCode()
    {
        return $this->getProperty('zip_postal_code');
    }
    
    /**
     * Get Authentication Token
     * 
     * @return string|null
     */
    public function getAuthenticationToken()
    {
        $s = new \Zend\Session\SessionManager();
        
        if($s->getStorage()->offsetExists('authentication_token') == true)
        {
            return $s->getStorage()->offsetGet('authentication_token');
        }
        
        return null;
    }
    
}

?>