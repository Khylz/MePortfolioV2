<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer les données dans la base de données
            $entityManager->persist($contact);
            $entityManager->flush(); // Sauvegarde dans la base de données

            // Envoyer l'e-mail
            $email = (new Email())
               ->from($contact->getMail())
               ->to('destinataire@example.com')
               ->subject($contact->getObject())
               ->text($contact->getMessage());

            $mailer->send($email);

            // Ajouter un message flash
            $this->addFlash('success', 'Votre message a été envoyé avec succès. 🎉');

            // Rediriger après la soumission pour éviter la soumission multiple
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


