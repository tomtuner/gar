<?php

/**
 * Description of NotificationModel
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Model;

use AppCore\Exception\ModelException;

class NotificationModel
{
  
    /**
     * Find Notifiees By Positions Ids
     * 
     * @param array $positionIds
     * @return array key = Position Owner Name; value = Position Owner E-mail
     * @throws ModelException
     */
    public function findNotifeesByPositionIds(array $positionIds)
    {
        try
        {
            $notificationGroups = \GARecruitingORM\PositionNotificationGroupQuery::create('alias')
                                    ->where('alias.PositionId IN ?', $positionIds)
                                    ->find();
            
            $notificationGroupsIds = array();
            
            foreach($notificationGroups as $notificationGroup)
            {
                array_push($notificationGroupsIds, $notificationGroup->getNotificationGroupId());
            }
                        
            $notifiees = \GARecruitingORM\NotifeeNotificationGroupQuery::create('alias')
                            ->where('alias.NotificationGroupId IN ?', $notificationGroupsIds)
                            ->find();
            
            $notificationList = array();
            
            foreach($notifiees as $notifiee)
            {
                //keep key like this
                //we don't want duplicate e-mails
                //if they key gets overwritten twice with the same person it is OK
                $notificationList[$notifiee->getNotifiee()->getNotifieeName()] = $notifiee->getNotifiee()->getNotifieeEmailAddress();
            }
            
            return $notificationList;
        }
        catch(\Exception $e)
        {
            throw new ModelException('Error Retrieving Notifiers', $e);
        }
    }
    
}

?>
