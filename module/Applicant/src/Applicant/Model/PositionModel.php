<?php

/**
 * Description of PositionModel
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Model;

use AppCore\Exception\ModelException;

class PositionModel
{

    /**
     * Find All Positions
     * 
     * @return PropelObjectCollection
     */
    public function findAll()
    {
        try
        {
            $q = \GARecruitingORM\PositionQuery::create()
						->filterByIsActive(1)
                        ->find();

            return $q;
        } 
        catch(\Exception $e)
        {
            throw new ModelException('Error Retrieving Positions', $e);
        }
    }

}

?>