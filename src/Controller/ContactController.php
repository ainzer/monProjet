<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\DemoFormType;
use App\Form\ContactFormType;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, MailService $ms): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //on crée une instance de Contact
            $message = new Contact();
            // Traitement des données du formulaire
            $data = $form->getData();
            //on stocke les données récupérées dans la variable $message
            $message = $data;

            $entityManager->persist($message);
            $entityManager->flush();

            // Redirection vers accueil
            //return $this->redirectToRoute('app_accueil');

            //envoi de mail avec notre service MailService
            $email = $ms->sendMail('hello@example.com', $message->getEmail(), $message->getObjet(), $message->getMessage() );
            //dd($message->getEmail());
        }


        return $this->render('/contact/index.html.twig', [
            'form' => $form
        ]);
    }
}