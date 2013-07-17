<?php

/**
 * Description of ApplicantModel
 *
 * @author Nikesh Hajari
 */

namespace Search\Model;

use Search\Service\Entity\ApplicantServiceEntity;
use AppCore\Exception\ModelException;
use AppCore\Exception\TransactionException;

class ApplicantModel
{

    /**
     * Find One Applicant
     * 
     * @return \GARecruitingORM\Applicant
     * @throws ModelException
     * @throws TransactionException
     */
    public function findOne(ApplicantServiceEntity $e)
    {
        try
        {
            $a = \GARecruitingORM\ApplicantQuery::create()
                    ->filterByApplicantId($e->getApplicantId())
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

}

?>