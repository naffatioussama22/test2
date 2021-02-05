<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ContratType;
use App\Entity\Contrat;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Voiture;
use App\Entity\Facture;
use App\Form\FactureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ContratController extends AbstractController
{
    /**
     * @Route("/contrat", name="contrat")
     */
    

 public function index(): Response
    {  $contrats=$this->getDoctrine()->getRepository(contrat::class)->findAll();
	return $this->render('contrat/index.html.twig',['contrats'=>$contrats,]);}

    /**
     * @Route("/createcontrat", name="createcnt")
     * @IsGranted("ROLE_AGENT")
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

      /**
     * @Route("/modifiercontrat/{id}", name="modifiercontratbyid")
     * @IsGranted("ROLE_AGENT")
     */
    public function modifier(string $id, Request $request): Response
    {
      $entityManger = $this->getDoctrine()->getManager() ;
      $Contrat = $this->getDoctrine()->getRepository(Contrat::class)->findBy($arrayName = array('id' => $id));
      if(!$Contrat)
      {
        throw $this->createNotFoundExeption(
          'pas de contrat avec ce id'.$id
        );


      }
      $Contrat=$Contrat[0];
      $form = $this->createForm(ContratType::class, $Contrat);
      $form->handleRequest($request);

      if ($form->isSubmitted())
      {
        $entityManger = $this->getDoctrine()->getManager();
        $entityManger->persist($Agence);
        $entityManger->flush();

           return $this->redirectToRoute('contrat');
      }
      return $this->render('contrat/modifier.html.twig',[
        'form'=>$form->createView()
      ]);}

/**
     * @Route("/supprimercontrat/{id}", name="supcontratbyid")
     * @IsGranted("ROLE_AGENT")
     */
    public function supprimer (String $id) : Response {
        $entityManager =$this->getDoctrine()->getManager();
        $Contrat=$this->getDoctrine()->getRepository(Contrat::class)->findBy(array('id'=>$id));
        if (!$Contrat){
          throw $this->createNotFoundException(
              'pas de contrat avec l"id"'.$id
          );
        }
        $entityManager->remove($User[0]);
        $entityManager->flush();
        return $this->redirectToRoute('user');
    }

}