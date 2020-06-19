<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{

    /**
     * @Route("/tutoriels/article/{slug}", name="tutoriels_article")
     *
     * @return void
     */
    public function post($slug) {

        $article = $this->getDoctrine()->getRepository(Articles::class)->findOneBy(['slug' => $slug]);
        $derniersPosts = $this->getDoctrine()->getRepository(Articles::class)->getDerniersPosts(3);
        $articlesRecents = $this->getDoctrine()->getRepository(Articles::class)->getDerniersPosts(2);
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        $totalArticles = $this->getDoctrine()->getRepository(Articles::class)->getNb();


        return $this->render('tutoriels/posts.html.twig', [
            'article' => $article,
            'derniersPosts' => $derniersPosts,
            'totalArticles' => $totalArticles,
            'categories' => $categories,
            'articlesRecents' => $articlesRecents
        ]);

    }
    
    /**
     * @Route("/tutoriels/{slug?}", name="tutoriels_home")
     */
    public function index(PaginatorInterface $paginator, Request $request, $slug)
    {
        


        if (!$slug) {
           $donnees = $this->getDoctrine()->getRepository(Articles::class)->findBy([], [
            'createdAt' => 'desc',
            ]); 
        }
        else {
            $idCat = $this->getDoctrine()->getRepository(Categories::class)->findOneBy(['slug' => $slug]);

            $donnees = $this->getDoctrine()->getRepository(Articles::class)->findBy(['categories' => $idCat->getId()], [
                'createdAt' => 'desc',
                ]); 
        }
        
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        $totalArticles = $this->getDoctrine()->getRepository(Articles::class)->getNb();
        $derniersPosts = $this->getDoctrine()->getRepository(Articles::class)->getDerniersPosts(3);

        //dd($totalArticles);

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
            'categories' => $categories,
            'totalArticles' => $totalArticles,
            'derniersPosts' => $derniersPosts
        ]);
    }

    
}
