<?php

/**
 * Description of PositionOwnerNotificationEmail
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Email;

use AppCore\Shared\Email\iEmail;
use AppCore\Service\Entity\iServiceEntity;

class PositionOwnerNotificationEmail implements iEmail
{

    /**
     * Service Entity
     * @var Applicant\Service\Entity\ApplicantServiceEntity
     */
    private $serviceEntity;

    /**
     * @see \AppCore\Shared\Email\iEmail::__construct
     */
    public function __construct(iServiceEntity $serviceEntity)
    {
        $this->serviceEntity = $serviceEntity;
    }

    /**
     * @see \AppCore\Shared\Email\iEmail::getMessage()
     */
    public function getMessage()
    {
        /*//construct new email message
        $m = new \AppMail\EmailMessage();

        //set subject
        $m->setSubject('RIT Graduate Assistantship Application Notification');

        //set from e-mail address
        $m->setFromEmailAddress('RIT Graduate Assistantship Recruiting', 'noreply-garecruiting@rit.edu');

        //set to e-mail address
        $m->setToEmailAddress($this->serviceEntity->getEmailAddress(), 
                                $this->serviceEntity->getFirstName() . " " . $this->serviceEntity->getLastName());
        
        $nM = new \Applicant\Model\NotificationModel();
        $notfiees = $nM->findNotifeesByPositionIds($this->serviceEntity->getPositionIds());
        
        foreach($notfiees as $notifieeName => $notifieeEmailAddress)
        {
               $m->setBccEmailAddress($notifieeEmailAddress, $notifieeName);
        }

        //set message content
        $mailBody = "This email serves to notify you that an application submission has been received for one or more of the positions 
                        you sponsor for the Student Affairs Graduate Assistantships.";

        //set message content
        $m->setMessage($mailBody);

        //return message
        return $m->getEmailMessage();*/
		
		$m  = new \Zend\Mail\Message();
		
		$m->setEncoding('utf-8');
		
		$m->addFrom('noreply-garecruiting@rit.edu', "RIT Graduate Assistantship Recruiting");
		
		$nM = new \Applicant\Model\NotificationModel();
        $notfiees = $nM->findNotifeesByPositionIds($this->serviceEntity->getPositionIds());
        
        foreach($notfiees as $notifieeName => $notifieeEmailAddress)
        {
			$m->addTo($notifieeEmailAddress, $notifieeName);
        }
		
		$m->setSubject('RIT Graduate Assistantship Application Notification');
		
		$m->setBody("This email serves to notify you that an application submission has been received for one or more of the positions you sponsor for the Student Affairs Graduate Assistantships."); 
		
		return $m;
    }

}

?>