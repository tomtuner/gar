<?php

/**
 * Description of SearchResultDocument
 *
 * @author Nikesh Hajari
 */

namespace Solr\GAR\Search;

use Solr\BaseDocument;

class SearchResultDocument extends BaseDocument
{

    /**
     * Get Applicant Id
     * 
     * @return string
     */
    public function getApplicantId()
    {
        return $this->getProperty('applicant_id');
    }

    /**
     * Get Applicant Address One
     * 
     * @return string
     */
    public function getApplicantAddressOne()
    {
        return $this->getProperty('applicant_address_one');
    }

    /**
     * Get Applicant Address Two
     * 
     * @return string
     */
    public function getApplicantAddressTwo()
    {
        return $this->getProperty('applicant_address_two');
    }

    /**
     * Get Applicant Essay Prior Experiences
     * 
     * @return string
     */
    public function getApplicantEssayPriorExperiences()
    {
        return $this->getProperty('applicant_essay_prior_experiences');
    }

    /**
     * Get Applicant Essay Personal Qualities
     * 
     * @return string
     */
    public function getApplicantEssayPersonalQualities()
    {
        return $this->getProperty('applicant_essay_personal_qualities');
    }

    /**
     * Get Applicant Reference One
     * 
     * @return string
     */
    public function getApplicantReferenceOne()
    {
        return $this->getProperty('applicant_reference_one');
    }

    /**
     * Get Applicant Reference Two
     * 
     * @return string
     */
    public function getApplicantReferenceTwo()
    {
        return $this->getProperty('applicant_reference_two');
    }

    /**
     * Get Applicant Reference Three
     * 
     * @return string
     */
    public function getApplicantReferenceThree()
    {
        return $this->getProperty('applicant_reference_three');
    }

    /**
     * Get Applicant Reference Name
     * 
     * @return string
     */
    public function getApplicantFirstName()
    {
        return $this->getProperty('applicant_first_name');
    }

    /**
     * Get Applicant Last Name
     * 
     * @return string
     */
    public function getApplicantLastName()
    {
        return $this->getProperty('applicant_last_name');
    }

    /**
     * Get Applicant Resume Cover Letter Attachment File Name
     * 
     * @return string
     */
    public function getApplicantResumeCoverLetterAttachmentFileName()
    {
        return $this->getProperty('applicant_resume_cover_letter_attachment_file_name');
    }

    /**
     * Get Applicant E-mail Address
     * 
     * @return string
     */
    public function getApplicantEmailAddress()
    {
        return $this->getProperty('applicant_email_address');
    }

    /**
     * Get Applicant Graduate Program
     * 
     * @return string
     */
    public function getApplicantGraduateProgram()
    {
        return $this->getProperty('applicant_graduate_program');
    }

    /**
     * Get Applicant City
     * 
     * @return string
     */
    public function getApplicantCity()
    {
        return $this->getProperty('applicant_city');
    }

    /**
     * Get Applicant Undergraduate Institution
     * 
     * @return string
     */
    public function getApplicantUndergraduateInstitution()
    {
        return $this->getProperty('applicant_undergraduate_institution');
    }

    /**
     * Get Applicant Graduate Institution
     * 
     * @return string
     */
    public function getApplicantGraduateInstitution()
    {
        return $this->getProperty('applicant_graduate_institution');
    }

    /**
     * Get Applicant Telephone Number
     * 
     * @return string
     */
    public function getApplicantTelephoneNumber()
    {
        return $this->getProperty('applicant_telephone_number');
    }

    /**
     * Get Applicant Zip Postal Code
     * 
     * @return string
     */
    public function getApplicantZipPostalCode()
    {
        return $this->getProperty('applicant_zip_postal_code');
    }
    
    /**
     * Get Applicant State Province Region
     * 
     * @return string
     */
    public function getApplicantStateProvinceRegion()
    {
        return $this->getProperty('applicant_state_province_region');
    }

    /**
     * Get Applicant Submission Date
     * 
     * @return string
     */
    public function getApplicantSubmissionDate()
    {
        return $this->getProperty('applicant_submission_date');
    }

    /**
     * Get Applicant Position Name
     * 
     * @return array
     */
    public function getApplicantPositionName()
    {
        return $this->getProperty('applicant_position_name');
    }

    /**
     * Get Applicant Resume Text
     * 
     * @return string
     */
    public function getApplicantResumeText()
    {
        return $this->getProperty('applicant_resume_text');
    }

}

?>