<?php

/**
 * Description of iMailer
 *
 * @author Nikesh Hajari
 */

namespace AppMail;

interface iMailer
{
    
    /**
     * Send Mail
     * 
     * @param \Zend\Mail\TransportInterface $transport Mail Transport Instance
     * @param \Zend\Mail\Message $mail
     * @return void
     */
    public function send(\Zend\Mail\TransportInterface $transport, \Zend\Mail\Message $mail);
        
}

?>