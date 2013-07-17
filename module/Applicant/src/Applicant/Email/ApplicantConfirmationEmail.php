<?php

/**
 * Description of ApplicantConfirmationEmail
 *
 * @author Nikesh Hajari
 */

namespace Applicant\Email;

use AppCore\Shared\Email\iEmail;
use AppCore\Service\Entity\iServiceEntity;

class ApplicantConfirmationEmail implements iEmail
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

        //set message content
        $mailBody = "Thank you for your interest in RIT's Graduate Assistantships in Student Affairs. 
                     This email serves as confirmation that your application has been completed and submitted.  
                     Once reviewed, you will receive notification of your application status.";

        //set message content
        $m->setMessage($mailBody);

        //return message
        return $m->getEmailMessage();*/
		
		$m  = new \Zend\Mail\Message();
		
		$m->setEncoding('utf-8');
		
		$m->addFrom('noreply-garecruiting@rit.edu', "RIT Graduate Assistantship Recruiting");
		
		$m->addTo($this->serviceEntity->getEmailAddress(), $this->serviceEntity->getFirstName() . " " . $this->serviceEntity->getLastName());
		
		$m->setSubject('RIT Graduate Assistantship Application Notification');
		
		$m->setBody("Thank you for your interest in RIT's Graduate Assistantships in Student Affairs. This email serves as confirmation that your application has been completed and submitted. Once reviewed, you will receive notification of your application status."); 
		
		return $m;
    }

}

?>