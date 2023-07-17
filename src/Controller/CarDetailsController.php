<?php

namespace App\Controller;

use App\Entity\CarsAd;
use App\Entity\Hours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarDetailsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/car/details/{id?}', name: 'app_car_details')]
    public function index($id): Response
    {

        $carDetails = $this->entityManager->getRepository(CarsAd::class)->findById(['id' => $id], []);
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        return $this->render('car_details/index.html.twig', [
            'carDetails' => $carDetails,
            'hours' => $hours
        ]);
    }
}
