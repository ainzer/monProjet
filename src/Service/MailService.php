<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;

class MailService
{
    private $mailer;

    //On injecte dans le constructeur le MailerInterface

    public function __construct(MailerInterface $mailer){
        $this->mailer = $mailer;
    }

//...

}