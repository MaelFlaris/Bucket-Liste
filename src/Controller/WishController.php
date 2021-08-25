<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $repo): Response
    {
        $whishes = $repo->findAll();

        return $this->render('wish/Home.html.twig',
        [
            'whishes' => $whishes
        ]
    );
    }
    /**
     * @Route("/About-us", name="About")
     */
    public function About(): Response
    {
        return $this->render('wish/About.html.twig');
    }
    /**
     * @Route("/AjoutWish", name="ajoutWish")
     */
    public function AjoutWish(): Response
    {
        return $this->render('wish/Ajout.html.twig');
    }
    /**
     * @Route("/Ajout", name="Ajout")
     */
    public function Ajout(EntityManagerInterface $em): Response
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $author = $_POST['author'];
        $isPublished = True;
        $date = new DateTime();
        $date->format('Y-m-d H:i:s');
        

        $wish = new Wish();
        $wish->setTitle($title);
        $wish->setDescription($description);
        $wish->setAuthor($author);
        $wish->setIsPublished($isPublished);
        $wish->setDateCreated($date);
        
        $em->persist($wish);
        $em->flush();
        
        return $this->redirectToRoute('home');
    }
    /**
     * @Route("/Contact", name="Contact")
     */
    public function Contact(): Response
    {
        return $this->render('wish/Contact.html.twig');
    }
}
