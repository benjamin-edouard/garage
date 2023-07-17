<?php

namespace App\Controller;

use App\Entity\Hours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    #[Route('/prestations', name: 'app_prestations')]
    public function index(): Response
    {
        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        return $this->render('prestations/index.html.twig', [
            'hours' => $hours,
        ]);
    }
}
