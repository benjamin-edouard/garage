<?php

namespace App\Controller;

use App\Entity\CarsAd;
use App\Entity\Hours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecondHandCarsController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/nos-occasions', name: 'app_second_hand_cars')]
    public function index(): Response
    {
        $carsAd = $this->entityManager->getRepository(CarsAd::class)->findAll();
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        return $this->render('second_hand_cars/index.html.twig', [
            'cars' => $carsAd,
            'hours' => $hours
        ]);
    }
}
