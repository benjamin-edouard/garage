<?php

namespace App\Controller;

use App\Entity\Hours;
use App\Entity\CarsAd;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use SendEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SecondHandCarsController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-occasions', name: 'app_second_hand_cars')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $carsAd = $this->entityManager->getRepository(CarsAd::class)->findAll();
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $sendEmail = new SendEmail();
            $sendEmail->send($mailer, $form);
            
            return $this->redirectToRoute('homepage', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('second_hand_cars/index.html.twig', [
            'cars' => $carsAd,
            'hours' => $hours,
            'form' => $form->createView()
        ]);
    }
}
