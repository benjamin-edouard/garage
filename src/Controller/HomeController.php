<?php

namespace App\Controller;

use App\Entity\Hours;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PDO;
use PDOException;
use SendEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;

class HomeController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
         $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $user = 'root';
        $password ='';

        try {
            $dbh = new PDO('mysql:host=localhost', $user, $password);
            // Creation of the database
            $dbh->exec('CREATE DATABASE IF NOT EXISTS garage');

            // Connection to the databse
            $createTable = new PDO('mysql:host=localhost;dbname=garage', $user, $password);
            
            // Creation of the table for the users
            $createTable->exec('CREATE TABLE IF NOT EXISTS user (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, user_firstname VARCHAR(50) NOT NULL, user_lastname VARCHAR(50) NOT NULL, user_email VARCHAR(50) NOT NULL UNIQUE, user_password TEXT, roles JSON NOT NULL)');

            // Creation of the table for the second hand ads
            $createTable->exec('CREATE TABLE IF NOT EXISTS cars_ad (id INT PRIMARY KEY NOT NULL, price INT NOT NULL, manufacture_year YEAR NOT NULL, milage INT NOT NULL, pictures JSON, date_publication DATE NOT NULL, ad_illustration VARCHAR(255) NULL)');
            
            // Creation of the table for the opening hours
            $createTable->exec('CREATE TABLE IF NOT EXISTS hours (id INT PRIMARY KEY AUTO_INCREMENT, day_of_week VARCHAR(20) NOT NULL, open_am TIME NOT NULL, close_am TIME NOT NULL, open_pm TIME NOT NULL, close_pm TIME NOT NULL)');
            
        } 
        catch(PDOException $e) {
            die('DB_ERROR : ' . $e->getMessage());
        }

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $sendEmail = new SendEmail();
            $sendEmail->send($mailer, $form);
            
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        $hours = $this->entityManager->getRepository(Hours::class)->findAll();

        return $this->render('home/index.html.twig', [
            'hours' => $hours,
            'form' => $form->createView()
        ]);
    }
}
