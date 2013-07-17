<?php

/**
 * Description of EmailMessage
 *
 * @author Nikesh Hajari
 */

namespace AppMail;

use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime as Mime;

class EmailMessage implements \AppMail\iEmailMessage
{
    /**
     * Mail Instance
     * @var  Zend\Mail 
     */
    private $mail;
    
    /**
     * Mime Part Collcetion
     * @var array Collection of Zend\Mime\Part Objects
     */
    private $mimePartCollection = array();
    
    /**
     * Class Default Constructor
     * 
     * Initializes new mail message 
     */
    public function __construct()
    {
        $this->mail = new \Zend\Mail\Message();
    }

    /**
     * @see iEmailMessage::getMessage()
     */
    public function getMessage()
    {
        return $this->mail->getBody();
    }

    /**
     * @see iEmailMessage::setMessage()
     */
    public function setMessage($message)
    {
        $mimePart = new MimePart($message);
        $mimePart->type = Mime::TYPE_TEXT;
        
        array_push($this->mimePartCollection, $mimePart);
    }
    
    /**
     * @see iEmailMessage::setHTMLMessage()
     */
    public function setHTMLMessage($message)
    {
        $mimePart = new MimePart($message);
        $mimePart->type = Mime::TYPE_HTML;
        
        array_push($this->mimePartCollection, $mimePart);
    }
    
    /**
     * @see iEmailMessage::setBccToEmailAddress()
     */
    public function setBccEmailAddress($bccEmailAddress, $bccRecipientName)
    {
        $this->mail->addBcc($bccEmailAddress, $bccRecipientName);
    }
    
    /**
     * @see iEmailMessage::getBccEmailAddress()
     */
    public function getBccEmailAddress()
    {
        return $this->mail->bcc();
    }

    /**
     * @see iEmailMessage::getSubject()
     */
    public function getSubject()
    {
        return $this->mail->subject();
    }

    /**
     * @see iEmailMessage::setSubject()
     */
    public function setSubject($subject)
    {
        $this->mail->setSubject($subject);
    }

    /**
     * @see iEmailMessage::getReplyToEmailAddress()
     */
    public function getReplyToEmailAddress()
    {
        return $this->mail->replyTo();
    }

    /**
     * @see iEmailMessage::setReplyToEmailAddress()
     */
    public function setReplyToEmailAddress($replyToEmailAddress, $replyToName)
    {
        $this->mail->addReplyTo($replyToEmailAddress, $replyToName);
    }

    /**
     * @see iEmailMessage::getFromEmailAddress()
     */
    public function getFromEmailAddress()
    {
        return $this->mail->from();
    }

    /**
     * @see iEmailMessage::setFromEmailAddress()
     */
    public function setFromEmailAddress($fromEmailAddress, $senderName)
    {
        $this->mail->addFrom($fromEmailAddress, $senderName);
    }

    /**
     * @see iEmailMessage::getToEmailAddress()
     */
    public function getToEmailAddress()
    {
        return $this->mail->to();
    }

    /**
     * @see iEmailMessage::setToEmailAddress()
     */
    public function setToEmailAddress($toEmailAddress, $recipientName)
    {
        $this->mail->addTo($toEmailAddress, $recipientName);
    }
   
    /**
     * @see iEmailMessage::setCcEmailAddress
     * @param type $ccEmailAddress
     * @param type $ccRecipientName
     */
    public function setCcEmailAddress($ccEmailAddress, $ccRecipientName)
    {
        $this->mail->addCc($ccEmailAddress, $ccRecipientName);
    }
    
    /**
     * @see iEmailMessage::getCcEmailAddress
     * @return type 
     */
    public function getCcEmailAddress()
    {
        return $this->mail->cc();
    }

    /**
     * @see iEmailMessage::getEmailMessage()
     */
    public function getEmailMessage()
    {
        
        /** 
         * this must be called to ensure the EOL setting is right
         * otherwise the header formatting will not be correct
         * caused the e-mail to look garbled or improperly formatted
         */
        $this->validateEOLSetting();
        
        $this->prepareEmail();

        if(!$this->mail->isValid())
        {
            throw new \Mail\Exception\MailException('Mail Message Is Missing Elements of an E-mail');
        }
        
        return $this->mail;
    }
    
    /**
     * Prepare E-Mail
     * 
     * Sets Content In E-mail and UTF-8 Encoding 
     */
    private function prepareEmail()
    {
        $body = new MimeMessage();
        $body->setParts($this->mimePartCollection);
        
        $this->mail->setBody($body);
        
        /**
         * this must be called after setting the body
         * otherwise the message will not come out correctly
         */
        $this->mail->setEncoding('UTF-8');
    }
    
    /**
     * Checks EOL Constant in \Zend\Mail\Headers
     * to ensure it is not equal to "\r\n". If it
     * is it should be set to PHP_EOL
     * 
     * @throws \Mail\Exception\MailException 
     */
    private function validateEOLSetting()
    {
        if(\Zend\Mail\Headers::EOL == "\r\n")
        {
            throw new \AppMail\Exception\MailException('Invalid EOL Setting in Zend\Mail\Headers. Set EOL constant equal to PHP_EOL');
        }
    }

}

?>