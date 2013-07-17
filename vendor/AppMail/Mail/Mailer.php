<?php

/**
 * Description of Mailer
 *
 * @author Nikesh Hajari
 */

namespace AppMail;

class Mailer implements \AppMail\iMailer
{
    /**
     * @see \Mail\iMailer::send()
     */
    public function send(\Zend\Mail\TransportInterface $transport, \Zend\Mail\Message $mail)
    {
        $transport->send($mail);
    }
    
}

?>