<?php

namespace App\Controller;

use App\Entity\Hours;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use SendEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $hours = $this->entityManager->getRepository(Hours::class)->findAll();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $sendEmail = new SendEmail();
            $sendEmail->send($mailer, $form);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact/index.html.twig', [
            'hours' => $hours,
            'form' => $form->createView()
        ]);
    }
}
