<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(): Response
    {
      $Clients = $this->getDoctrine()->getRepository(Client::class)->findAll();
        return $this->render('client/index.html.twig', [
            'Clients' =>   $Clients,
        ]);
    }

    /**
     * @Route("/createclient", name="create_client")
     * @IsGranted("ROLE_ADMIN")
     */
     public function createclient(Request $request):Response
     {
       $Client = new Client();
       $form = $this->createForm(ClientType::class,$Client);

       $form->handleRequest($request);
       if ($form->isSubmitted())
       {
         $entityManger = $this->getDoctrine()->getManager();
         $entityManger->persist($Client);
         $entityManger->flush();

            return $this->redirectToRoute('client');
       }
       return $this->render('client/ajouter.html.twig',[
         'form'=>$form->createView()
       ]);}

       /**
        * @Route("/modifierclient/{numpermis}", name="modifierclientbynpermis")
        * @IsGranted("ROLE_ADMIN")
        */
       public function modifier(string $numpermis, Request $request): Response
       {
         $entityManger = $this->getDoctrine()->getManager() ;
         $Client = $this->getDoctrine()->getRepository(Client::class)->findBy($arrayName = array('numpermis' => $numpermis ));
         if(!$Client)
         {
           throw $this->createNotFoundExeption(
             'pas d agence avec le nom'.$numpermis
           );

         }
         $Client=$Client[0];
         $form = $this->createForm(ClientType::class, $Client);
         $form->handleRequest($request);

         if ($form->isSubmitted())
         {
           $entityManger = $this->getDoctrine()->getManager();
           $entityManger->persist($Client);
           $entityManger->flush();

              return $this->redirectToRoute('client');
         }
         return $this->render('client/modifier.html.twig',[
           'form'=>$form->createView()
         ]);}

         /**
          * @Route("/supprimerclient/{numpermis}", name="supprimerclientbynpermis")
          * @IsGranted("ROLE_ADMIN")
          */
         public function supprimer(string $numpermis): Response
         {
           $entityManger = $this->getDoctrine()->getManager() ;
           $Clients = $this->getDoctrine()->getRepository(Client::class)->findBy($arrayName = array('numpermis' => $numpermis ));
           if(!$Clients)
           {
             throw $this->createNotFoundException(
               'pas d agence avec l'.$numpermis
             );

           }
           $entityManger->remove($Clients[0]);
           $entityManger->flush();
             return $this->redirectToRoute('client');
         }


}