<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Facture;
use App\Entity\Contrat;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FactureType;
use App\Entity\Client;

use Symfony\Component\Controller\Extension\Core\Type\DateType;

class FactureController extends AbstractController
{
    /**
     * @Route("/facture", name="facture")
     */
    public function index(): Response
    {
      $Factures = $this->getDoctrine()->getRepository(Facture::class)->findAll();
      $Contrats = $this->getDoctrine()->getRepository(Contrat::class)->findAll();

        return $this->render('facture/index.html.twig', [
            'Factures' =>   $Factures,
            'Contrats' => $Contrats
        ]);
    }

    /**
     * @Route("/createfacture", name="create_facture")
     */
     public function createfacture(Request $request):Response
     {
       $Facture = new Facture();
       $form = $this->createForm(FactureType::class,$Facture);

           $form->handleRequest($request);
       if ($form->isSubmitted())
       {
         $Contrats = $this->getDoctrine()->getRepository(Contrat::class)->findAll();


         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($Facture);
         $entityManger->flush();

            return $this->redirectToRoute('facture');
       }
       return $this->render('facture/ajouter.html.twig',[
         'form'=>$form->createView()
       ]);}

       /**
        * @Route("/modifierfacture/{id}", name="modifierfacturebyid")
        */
       public function modifier(string $id, Request $request): Response
       {
         $entityManger = $this->getDoctrine()->getManager() ;
         $Facture = $this->getDoctrine()->getRepository(Facture::class)->findBy($arrayName = array('id' => $id ));
         if(!$Facture)
         {
           throw $this->createNotFoundExeption(
             'pas de facture avec le num'.$id
           );

         }
         $Facture=$Facture[0];
         $form = $this->createForm(FactureType::class, $Facture);
         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
           $entityManger = $this->getDoctrine()->getManager();
           $entityManger->persist($Facture);
           $entityManger->flush();

              return $this->redirectToRoute('facture');
         }
         return $this->render('facture/modifier.html.twig',[
           'form'=>$form->createView()
         ]);}

         /**
          * @Route("/supprimerfacture/{id}", name="supprimerfacturebyid")
          */
         public function supprimer(string $id): Response
         {
           $entityManger = $this->getDoctrine()->getManager() ;
           $Factures = $this->getDoctrine()->getRepository(Facture::class)->findBy($arrayName = array('id' => $id ));
           if(!$Factures)
           {
             throw $this->createNotFoundException(
               'pas de facture avec le num '.$Facture
             );

           }
           $entityManger->remove($Factures[0]);
           $entityManger->flush();
             return $this->redirectToRoute('facture');
         }

         /**
          * @Route("/payee/{id}", name="payeebyid")
          */
         public function payee(string $id, Request $request): Response
         {
           $entityManger = $this->getDoctrine()->getManager() ;
           $Factures = $this->getDoctrine()->getRepository(Facture::class)->findBy($arrayName = array('id' => $id ));
           if(!$Factures)
           {
             throw $this->createNotFoundExeption(
               'pas de voiture avec la matricule'.$id
             );
             }

  {
  $Factures[0]->setPayee(1);
  $entityManger->flush();
  return $this->redirectToRoute('voiture');
  }
  }
}