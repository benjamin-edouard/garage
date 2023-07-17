<?php

namespace App\Controller;

use App\Entity\Hours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {

        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        return $this->render('contact/index.html.twig', [
            'hours' => $hours,
        ]);
    }
}
