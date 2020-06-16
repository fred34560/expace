<?php

namespace App\Controller;

use App\Entity\Articles;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/tutoriels", name="tutoriels_home")
     */
    public function index(PaginatorInterface $paginator, Request $request)
    {
        $donnees = $this->getDoctrine()->getRepository(Articles::class)->findBy([], ['createdAt' => 'desc']);

        //dd($result);

        $pagination = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );
        $pagination->setCustomParameters([
            'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination)
        ]);
        $pagination->setTemplate( 'partials/paginator.html.twig');

        return $this->render('tutoriels/index.html.twig', [
            'pagination' => $pagination,
            'articles' => $donnees
        ]);
    }
}
