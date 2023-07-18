<?php

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendEmail {

    public function send(MailerInterface $mailer, $form) {

        $lastName = $form->get('user-lastname')->getData();
        $firstName = $form->get('user-firstname')->getData();
        $email = $form->get('user-email')->getData();
        $subject = $form->get('subject')->getData();
        $phoneNumber = $form->get('user-telephone')->getData();
        $message = $form->get('user-message')->getData();
        $text = 'Bonjour, \r\n Vous avez reçu un message de '.$lastName.' '.$firstName.'('.$phoneNumber.' - '.$email.'). \r\n Voici son message : \r\n'.$message;

        $email = (new Email())
            ->from($email)
            ->to('contact@vincent-parrot.fr')
            ->replyTo($email)
            ->subject($subject)
            ->text($text);
            
        $mailer->send($email);        
    }
}