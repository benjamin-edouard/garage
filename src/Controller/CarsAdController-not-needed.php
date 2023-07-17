<?php

namespace App\Controller;

use App\Entity\CarsAd;
use App\Form\CarsAd1Type;
use App\Repository\CarsAdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cars_ad')]
class CarsAdController extends AbstractController
{
    #[Route('/', name: 'app_cars_ad_index', methods: ['GET'])]
    public function index(CarsAdRepository $carsAdRepository): Response
    {
        return $this->render('cars_ad/index.html.twig', [
            'cars_ads' => $carsAdRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cars_ad_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $carsAd = new CarsAd();
        $form = $this->createForm(CarsAd1Type::class, $carsAd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carsAd);
            $entityManager->flush();

            return $this->redirectToRoute('app_cars_ad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cars_ad/new.html.twig', [
            'cars_ad' => $carsAd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cars_ad_show', methods: ['GET'])]
    public function show(CarsAd $carsAd): Response
    {
        return $this->render('cars_ad/show.html.twig', [
            'cars_ad' => $carsAd,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cars_ad_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CarsAd $carsAd, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CarsAd1Type::class, $carsAd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cars_ad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cars_ad/edit.html.twig', [
            'cars_ad' => $carsAd,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cars_ad_delete', methods: ['POST'])]
    public function delete(Request $request, CarsAd $carsAd, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carsAd->getId(), $request->request->get('_token'))) {
            $entityManager->remove($carsAd);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cars_ad_index', [], Response::HTTP_SEE_OTHER);
    }
}
