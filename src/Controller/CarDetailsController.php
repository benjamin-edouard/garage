<?php

namespace App\Controller;

use App\Entity\CarsAd;
use App\Entity\Hours;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use SendEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CarDetailsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/car/details/{id?}', name: 'app_car_details')]
    public function index($id, Request $request, MailerInterface $mailer): Response
    {

        $carDetails = $this->entityManager->getRepository(CarsAd::class)->findById(['id' => $id], []);
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $sendEmail = new SendEmail();
            $sendEmail->send($mailer, $form);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('car_details/index.html.twig', [
            'carDetails' => $carDetails,
            'hours' => $hours,
            'form' => $form->createView()
        ]);
    }
}
