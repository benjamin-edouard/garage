<?php

namespace App\Controller;

use App\Entity\Hours;
use App\Entity\Services;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use SendEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/prestations', name: 'app_prestations')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $services = $this->entityManager->getRepository(Services::class)->findAll();
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $sendEmail = new SendEmail();
            $sendEmail->send($mailer, $form);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('prestations/index.html.twig', [
            'services' => $services,
            'hours' => $hours,
            'form' => $form->createView()
        ]);
    }
}
