<?php

/**
 * Description of ApplicantModel
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Model;

use Applicant\Service\Entity\ApplicantServiceEntity;
use AppCore\Exception\ModelException;
use AppCore\Exception\TransactionException;

class ApplicantModel
{

    /**
     * Create Applicant
     * 
     * @param \Applicant\Service\Entity\ApplicantServiceEntity $e
     * @return integer Applicant Id
     * @throws ModelException
     */
    public function create(ApplicantServiceEntity $e)
    {
        $c = \Propel::getConnection('ga_recruiting');
        $c->beginTransaction();

        try
        {
            $a = new \GARecruitingORM\Applicant();
            $a->setApplicantFirstName($e->getFirstName());
            $a->setApplicantLastName($e->getLastName());
            $a->setApplicantEmailAddress($e->getEmailAddress());
            $a->setApplicantTelephoneNumber($e->getTelephoneNumber());
            $a->setApplicantAddressOne($e->getAddressOne());
            $a->setApplicantAddressTwo($e->getAddressTwo());
            $a->setApplicantCity($e->getCity());
            $a->setApplicantZipPostalCode($e->getZipPostalCode());
            $a->setApplicantStateProvinceRegion($e->getStateProvinceRegion());
            $a->setApplicantCountry($e->getCountry());
            $a->setApplicantUndergraduateInstitution($e->getUndergraduateInstitution());
            $a->setApplicantGraduateInstitution($e->getGraduateInstitution());
            $a->setApplicantGraduateProgram($e->getGraduateProgram());
            $a->setApplicantReferenceOne($e->getReferenceOne());
            $a->setApplicantReferenceTwo($e->getReferenceTwo());
            $a->setApplicantReferenceThree($e->getReferenceThree());
            $a->setApplicantEssayPersonalQualities($e->getPersonalQualitiesQuestion());
            $a->setApplicantEssayPriorExperiences($e->getPriorExperiencesQuestion());
            $a->setApplicantResumeCoverLetterAttachmentFileName($e->getResumeCoverLetterAttachmentFileName());
            $a->setApplicantSubmissionDate('now');
            $a->setApplicantSubmissionLastUpdate('now');
            
            $u = \GARecruitingORM\UserQuery::create()
                       ->filterByAuthenticationToken($e->getAuthenticationToken())
                       ->findOne($c);
            
            $a->setUser($u);
            $a->save($c);
            
            foreach($e->getPositionIds() as $positionId)
            {
                $p = new \GARecruitingORM\ApplicantPosition();
                $p->setApplicant($a);
                $p->setPositionId($positionId);
                $p->save($c);
            }

            $c->commit();

            return $a->getApplicantId();
        } catch(\Exception $e)
        {
            $c->rollBack();
            throw new ModelException('Error Creating Applicant', $e);
        }
    }

    /**
     * Update Applicant
     * 
     * @param \Applicant\Service\Entity\ApplicantServiceEntity $e
     * @throws ModelException
     */
    public function update(ApplicantServiceEntity $e)
    {
        $c = \Propel::getConnection('ga_recruiting');
        $c->beginTransaction();

        try
        {
            $a = \GARecruitingORM\ApplicantQuery::create()
                     ->useUserQuery()
                        ->filterByAuthenticationToken($e->getAuthenticationToken())
                     ->endUse()
                     ->findOne($c);

            $a->setApplicantFirstName($e->getFirstName());
            $a->setApplicantLastName($e->getLastName());
            $a->setApplicantTelephoneNumber($e->getTelephoneNumber());
            $a->setApplicantAddressOne($e->getAddressOne());
            $a->setApplicantAddressTwo($e->getAddressTwo());
            $a->setApplicantCity($e->getCity());
            $a->setApplicantZipPostalCode($e->getZipPostalCode());
            $a->setApplicantCountry($e->getCounty());
            $a->setApplicantUndergraduateInstitution($e->getUndergraduateInstitution());
            $a->setApplicantGraduateInstitution($e->getGraduateInstitution());
            $a->setApplicantGraduateProgram($e->getGraduateProgram());
            $a->setApplicantReferenceOne($e->getReferenceOne());
            $a->setApplicantReferenceTwo($e->getReferneceTwo());
            $a->setApplicantReferenceThree($e->getReferenceThree());
            $a->setApplicantEssayPersonalQualities($e->getEssayPersonalQualities());
            $a->setApplicantEssayPriorExperiences($e->getEssayPriorExperiences());
            $a->setApplicantResumeCoverLetterAttachmentPath($e->getResumeCoverLetterAttachmentPath()); //fix me - returns file object
            $a->setApplicantSubmissionLastUpdate('now');
            $a->save($c);
            
            $p = \GARecruitingORM\ApplicantPositionQuery::create()
                    ->filterByApplicant($a)
                    ->delete($c);
            
            foreach($e->getPositionIds() as $positionId)
            {
                $p = new \GARecruitingORM\ApplicantPosition();
                $p->setApplicant($a);
                $p->setPositionId($positionId);
                $p->save($c);
            }

            $c->commit();
        } catch(\Exception $e)
        {
            $c->rollBack();
            throw new ModelException('Error Updating Applicant', $e);
        }
    }

    /**
     * Find One Applicant
     * 
     * @param integer $userId
     * @return \GARecruitingORM\Applicant
     * @throws ModelException
     * @throws TransactionException
     */
    public function findOne(ApplicantServiceEntity $e)
    {
        try
        {
            $a = \GARecruitingORM\ApplicantQuery::create()
                     ->useUserQuery()
                        ->filterByAuthenticationToken($e->getAuthenticationToken())
                     ->endUse()
                     ->findOne();

            if($a)
            {
                return $a;
            }

            throw new TransactionException('Error Finding Record for Applicant');
        } catch(\Exception $e)
        {
            throw new ModelException('Error Finding Applicant', $e);
        }
    }
    
    public function hasSubmittedApplication(ApplicantServiceEntity $e)
    {
        try
        {
            $a = \GARecruitingORM\ApplicantQuery::create()
                     ->useUserQuery()
                        ->filterByAuthenticationToken($e->getAuthenticationToken())
                     ->endUse()
                     ->findOne();

            if($a)
            {
                return true;
            }

            return false;
            
        } catch(\Exception $e)
        {
            throw new ModelException('Error Finding If Application Has Been Submitted', $e);
        }
    }

}

?>