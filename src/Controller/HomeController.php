<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class HomeController extends AbstractController
{
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/nous-contacter", name="home_contact")
     *
     * @return void
     */
    public function contact() {
        return $this->render('contact.html.twig');
    }

    /**
     * @Route("/nos-services", name="home_services")
     *
     * @return void
     */
    public function services() {
        return $this->render('services.html.twig');
    }

    /**
     * @Route("/politique-de-confidentialite", name="home_confidentialite")
     *
     * @return void
     */
    public function confidentialite() {
        return $this->render('confidentialite.html.twig');
    }

    
}
