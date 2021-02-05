<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AgenceType;

class AgenceController extends AbstractController
{
    /**
     * @Route("/agence", name="agence")
     */
    public function index(): Response
    {
      $Agences = $this->getDoctrine()->getRepository(Agence::class)->findAll();
        return $this->render('agence/index.html.twig', [
            'Agences' =>   $Agences,
        ]);
    }
    /**
     * @Route("/createagence", name="create_agence")
     */
     public function createAgence(Request $request):Response
     {
       $Agence = new Agence();
       $form = $this->createForm(AgenceType::class,$Agence);

       $form->handleRequest($request);
       if ($form->isSubmitted())
       {
         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($Agence);
         $entityManger->flush();

            return $this->redirectToRoute('agence');
       }
       return $this->render('agence/ajouter.html.twig',[
         'form'=>$form->createView()
       ]);}



       /**
        * @Route("/modifieragence/{Nom}", name="modifieragencebynom")
        */
       public function modifier(string $Nom, Request $request): Response
       {
         $entityManger = $this->getDoctrine()->getManager() ;
         $Agence = $this->getDoctrine()->getRepository(Agence::class)->findBy($arrayName = array('Nom' => $Nom ));
         if(!$Agence)
         {
           throw $this->createNotFoundExeption(
             'pas d agence avec le nom'.$Nom
           );

         }
         $Agence=$Agence[0];
         $form = $this->createForm(AgenceType::class, $Agence);
         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
           $entityManger = $this->getDoctrine()->getManager();
           $entityManger->persist($Agence);
           $entityManger->flush();

              return $this->redirectToRoute('agence');
         }
         return $this->render('agence/modifier.html.twig',[
           'form'=>$form->createView()
         ]);}

         /**
          * @Route("/supprimeragence/{id}", name="supprimeragencebyid")
          */
         public function supprimer(string $id): Response
         {
           $entityManger = $this->getDoctrine()->getManager() ;
           $Agences = $this->getDoctrine()->getRepository(Agence::class)->findBy($arrayName = array('id' => $id ));
           if(!$Agences)
           {
             throw $this->createNotFoundException(
               'pas d agence avec l'.$id
             );

           }
           $entityManger->remove($Agences[0]);
           $entityManger->flush();
             return $this->redirectToRoute('agence');
         }

         /**
          * @Route("/agence/{Nom}", name="agencebynom")
          */
         public function afficher(string $Nom): Response
         {
           $Agences = $this->getDoctrine()->getRepository(Agence::class)->findBy($arrayName = array('Nom' => $Nom ));
             return $this->render('agence/index.html.twig', [
                 'Agences' =>   $Agences,
             ]);

}
}
