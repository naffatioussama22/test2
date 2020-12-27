<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContratType;
use App\Entity\Contrat;
use Symfony\Component\HttpFoundation\Request;

class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    public function index(): Response
    {
        return $this->render('contrat/index.html.twig', [
            'controller_name' => 'ContratController',
        ]);
    }



    /**
     * @Route("/createcontrat", name="createcnt")
     */
    public function creatContrat(Request $request) :Response {
        

        $Contrat=new Contrat();
        $form=$this->createForm(ContratType::class,$Contrat);

        $form->handleRequest($request);
        if ($form ->isSubmitted() ){
            $entityManager= $this->getDoctrine()->getManager();
            $entityManager->persist($Contrat);
            $entityManager->flush();

            return $this->redirectToRoute('contrat');

        }
        return $this->render('contrat/create.html.twig',[
            'form'=>$form->createView()]);

    }
}