<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\Request;
//use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Article;
use App\Repository\ArticleRepository;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class);

                $articles = $repo->findAll();
        

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles 
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'title' => 'Bienvenue sur mon blog',
        ]);
    }
    
    
     /**
        * @Route("/blog/new", name="blog_create")
     */
    
    public function create(){//Request $request, ObjectManager $manager){
        $article = new Article();
        
    $form = $this->createFormBuilder($article)
        ->add('title')
        ->add('content')
        ->add('image')
        ->getForm();

        return $this->render('blog/create.html.twig', [
            'formArticle' => $form->createView()
        ]);
                }
    
        

    /**
     * @Route("/blog/{id}", name="blog_show")
     */

    // public function show(ArticleRepository $repo, $id){ 
    // INJECTION DE DEPENDENCES // la tu utilises le param converter pour faciliter alléger le code
    public function show(Article $article){
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->find($id);
        
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
