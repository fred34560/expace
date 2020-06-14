<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/tutoriels", name="tutoriels_home")
     */
    public function index()
    {
        return $this->render('tutoriels/index.html.twig');
    }
}
