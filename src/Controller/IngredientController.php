<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IngredientController extends AbstractController
{
    private $repo;
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientRepository $repo, PaginatorInterface $paginator,Request $request): Response
    {
        $ingredient = $paginator->paginate($repo->findAll(), $request->query->getInt('page', 1),) ;
        return $this->render('ingredient/index.html.twig', ['ingredients' => $ingredient
            
        ]);
    }

   /**
    * @Route("/creation-ingredient", name="creation-ingredient")
    */
   public function create(Request $request): Response
   {
       $ingredient = new Ingredient();
       $form = $this->createForm(IngredientType::class, $ingredient);
       $form->handleRequest($request);


       return $this->render('ingredient/create-ingredient.html.twig', ['form'=>$form->createView()]);
   }
}
