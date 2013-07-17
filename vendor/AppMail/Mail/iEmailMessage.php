<?php

/**
 * Description of iEmailMessage
 *
 * @author Nikesh Hajari
 */

namespace AppMail;

interface iEmailMessage
{
    /**
     * Get E-mail Message Body
     * 
     * @return string 
     */
    public function getMessage();

    /**
     * Set E-mail Message Body
     * 
     * @param string $message E-mail Message Body
     * @return void 
     */
    public function setMessage($message);
    
    /**
     * Set HTML Message Body
     * 
     * @param string $message HTML Code
     * @return void 
     */
    public function setHTMLMessage($message);

    /**
     * Get E-mail Subject Line
     * 
     * @return string 
     */
    public function getSubject();

    /**
     * Set E-mail Subject Line
     * 
     * @param string $subject E-mail Subject Line
     * @return void 
     */
    public function setSubject($subject);

    /**
     * Get Reply To Email Address
     * 
     * <code>
     *  foreach ($message->replyTo() as $address) {
     *     printf("%s: %s\n", $address->getEmail(), $address->getName());
     *  }
     * </code>
     * 
     * @return array Collection of Reply To Addresses
     */
    public function getReplyToEmailAddress();

    /**
     * Set Reply To Email Address
     * 
     * Supports multiple to addresses. Call method multiple times to
     * add additional addresses.
     * 
     * @param string $replyToEmailAddress The E-mail Address Of The Reply to Contact
     * @param string $replyToName Name of Reply to Person
     * @return void 
     */
    public function setReplyToEmailAddress($replyToEmailAddress, $replyToName);

    /**
     * Get From E-mail Address
     * 
     * <code>
     *  foreach ($message->from() as $address) {
     *     printf("%s: %s\n", $address->getEmail(), $address->getName());
     *  }
     * </code>
     * 
     * @return array Collection of From Addresses 
     */
    public function getFromEmailAddress();

    /**
     * Set From E-mail Address
     * 
     * Supports multiple to addresses. Call method multiple times to
     * add additional addresses.
     * 
     * @param string $fromEmailAddress E-mail Address of Sender
     * @param string $senderName Name of Sender
     * @return void 
     */
    public function setFromEmailAddress($fromEmailAddress, $senderName);

    /**
     * Get To E-mail Address
     * 
     * <code>
     *  foreach ($message->to() as $address) {
     *     printf("%s: %s\n", $address->getEmail(), $address->getName());
     *  }
     * </code>
     * 
     * @return array Collection of To E-mail Addresses 
     */
    public function getToEmailAddress();

    /**
     * Set To E-mail Address
     * 
     * Supports multiple to addresses. Call method multiple times to
     * add additional addresses.
     *
     * @param string $toEmailAddress E-mail Address of Mail Being Sent To
     * @param string $recipientName Name of Recipient
     * @return void 
     */
    public function setToEmailAddress($toEmailAddress, $recipientName);
    
    /**
     * Get E-mail Message
     * 
     * @return Zend\Mail
     * @throws \Mail\MailException;
     */
    public function getEmailMessage();
    
    /**
     * Set Cc Email Address
     * 
     * Supports multiple to addresses. Call method multiple times to
     * add additional addresses.
     * 
     * @param string $ccEmailAddress E-mail Address of CC reciient
     * @param string $ccRecipientName Name of Recipient
     * @return void
     */
    public function setCcEmailAddress($ccEmailAddress, $ccRecipientName);
    
    /**
     * Get Cc E-mail Address
     * 
     * <code>
     *  foreach ($message->cc() as $address) {
     *     printf("%s: %s\n", $address->getEmail(), $address->getName());
     *  }
     * </code>
     *      * 
     * @return array Collection of Cc E-mail Addresses
     */
    public function getCcEmailAddress();
    
    /**
     * Get Bcc E-mail Address
     * 
     * <code>
     *  foreach ($message->bcc() as $address) {
     *     printf("%s: %s\n", $address->getEmail(), $address->getName());
     *  }
     * </code>
     *      * 
     * @return array Collection of Bcc E-mail Addresses
     */
    public function getBccEmailAddress();
    
    /**
     * Set Bcc Email Address
     * 
     * Supports multiple to addresses. Call method multiple times to
     * add additional addresses.
     * 
     * @param string $bccEmailAddress
     * @param string $bccRecipientName
     * @return void      
     */
    public function setBccEmailAddress($bccEmailAddress, $bccRecipientName);
}
?>