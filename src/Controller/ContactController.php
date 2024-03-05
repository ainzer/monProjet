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
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ContactController extends AbstractController
{
    
    #[IsGranted('ROLE_CLIENT', message: "Nous sommes désolés, vous ne disposez pas des autorisations nécessaires pour accèder à cette page!")]
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, MailService $ms): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);
            //on crée une instance de Contact
            $message = new Contact();
            $data = $form->getData();
            //             //on stocke les données récupérées dans la variable $message
            $message = $data;

            $entityManager->persist($message);
            $entityManager->flush();

            //envoi de mail avec notre service MailService
            $ms->sendMail('hello@example.com', $message->getEmail(), $message->getObjet(), $message->getMessage() );
            // dd($message->getEmail());
            // Redirection vers accueil
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('contact/index.html.twig', [
            'form'=> $form
        ]);
    }
}







// namespace App\Controller;

// use App\Entity\Contact;
// use App\Form\DemoFormType;
// use App\Form\ContactFormType;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Validator\Constraints as Assert;

// class ContactController extends AbstractController
// {
//     #[Route('/contact', name: 'app_contact')]
//     public function index(Request $request, EntityManagerInterface $entityManager): Response
//     {    
//         $form = $this->createForm(ContactFormType::class, null);
//         $form->handleRequest($request);


//         if ($form->isSubmitted() && $form->isValid()) {

//             //on crée une instance de Contact
//             $message = new Contact();
//             // Traitement des données du formulaire
//             $data = $form->getData();
//             //on stocke les données récupérées dans la variable $message
//             $message = $data;
//             //persistance des données
//             $entityManager->persist($message);
//             $entityManager->flush();

//             // Redirection vers accueil
//             return $this->redirectToRoute('app_accueil');
//         }

//         return $this->render('contact/index.html.twig', [
// //            'form' => $form->createView(),
//               'form' => $form
//         ]);
//     }
// }