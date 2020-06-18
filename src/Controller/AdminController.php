<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Categories;
use App\Form\CreateArticleFormType;
use App\Form\CreateCategorieFormType;
use App\Form\CreateCategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(Request $request, EntityManagerInterface $manager)
    {
        $categorie = new Categories();
        $createCategorie = $this->createForm(CreateCategorieFormType::class, $categorie);
        $createCategorie->handleRequest($request);

        $article = new Articles();
        $createArticle = $this->createForm(CreateArticleFormType::class, $article);
        $createArticle->handleRequest($request);

        if ($createArticle->isSubmitted() && $createArticle->isValid()) {

            $user = $this->getUser();

            $article->setUsers($user);
            //dd($article);
            $manager->persist($article);
            $manager->flush();
        }




        if ($createCategorie->isSubmitted() && $createCategorie->isValid()) {
            $manager->persist($categorie);
            $manager->flush();

        }
        return $this->render('admin/index.html.twig', [
            'createCategorie' => $createCategorie->createView(),
            'createArticle' => $createArticle->createView()
        ]);
    }
}
