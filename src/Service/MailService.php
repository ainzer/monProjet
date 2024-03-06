<?php
namespace App\Service; 
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use SebastianBergmann\Template\Template;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;
//...

/*
class MailService
{
    //On injecte l'interface ParameterBag

    private $paramBag;
    private $mailer;
    public function __construct(ParameterBagInterface $paramBag, MailerInterface $mailer){

        //$this->paramBag = $paramBag;
        //$this->mailer = $mailer;
    }

    public function sendMail($expediteur, $destinataire, $sujet, $message)
    {
    //On se sert du parameterBag et du nom du paramètre ('image_directory') pour récupèrer le chemin du dossier "images"
    $dossiers_images = $this->paramBag->get('images_directory'); 

    $email = (new TemplatedEmail())
    ->from('tututoto@gmail.com')
    ->to('feur@gmail.com')
    ->subject('Time for Symfony Mailer!')
    ->text('Sending emails is fun again!')
    ->htmlTemplate('mailer/index.html.twig'); 
    $this->mailer->send($email);
    }
    

        
//...
    

} */