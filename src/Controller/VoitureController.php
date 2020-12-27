<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class VoitureController extends AbstractController
{
    /**
     * @Route("/createvoiture", name="create_voiture")
     */
	public function createVoiture(Request $request):Response
	{
	$voiture= new voiture();
	$form=$this->createForm(Voituretype::class,$voiture);
	
	$form->handleRequest($request);
	
	if($form->isSubmitted()&& $form->isValid()){
		 $voiture->setdisponibilite(1);
		 $entityManager=$this->getDoctrine()->getManager();
		 $entityManager->persist($voiture);
	$entityManager->flush();
		return $this->redirectToRoute('voiture');
	}
	return $this->render('voiture/ajouter.html.twig',['form'=>$form->createView()]);
}
/**
     * @Route("/modifiervoiture/{mat}", name="editvoiturebymat")
     */	 
	 
	public function modifier(Request $request, String $mat): Response
	{
		$entitymanager = $this->getDoctrine()->getManager();
		$voiture=$this->getDoctrine()->getRepository(voiture::class)->findBy(array('matricule' => $mat));

		if (!$voiture) {
            throw $this->createNotFoundException(
                'pas de voiture avec la matricule' . $mat
            );
        }
        $voiture = $voiture[0];
     

        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        echo ($form->isSubmitted());
        if ($form->isSubmitted()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('voiture');
        }

        return $this->render('voiture/modifier.html.twig', ['form' => $form->createView()]);
	}	 
	 /**
      * @Route("/supprimervoiture/{mat}", name="supvoiture")
	  */
	  public function supprimer(String $mat): Response
	  {
		$entityManager =$this->getDoctrine()->getManager();
        $voiture=$this->getDoctrine()->getRepository(voiture::class)->findBy(array('matricule'=>$mat));
        if (!$voiture){
          throw $this->createNotFoundException(
              'pas de voiture avec la matricule'.$mat
          );
        }
        $entityManager->remove($voiture[0]);
        $entityManager->flush();
        return $this->redirectToRoute('voiture');
    }		

 /**
     * @Route("/voiture", name="voiture")
     */
    public function index(): Response
    {  $voitures=$this->getDoctrine()->getRepository(voiture::class)->findAll();
	return $this->render('voiture/index.html.twig',['voitures'=>$voitures,]);}
    
    /**
     * @Route("/admin", name="admin")
	  * @IsGranted("ROLE_ADMIN")
     */
public function admin()
{ $this->denyAccessUnlessGranted('ROLE_ADMIN');

    $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findAll();

    $users = $this->getDoctrine()->getRepository(User::class)->findAll();

   
            return $this->render('admin/index.html.twig', [
             'voitures' => $voitures,
             'users' => $users
    ]);

}

/**
        * @Route("/louer/{mat}", name="louerbaymat")
        */
        public function louer(string $mat, Request $request): Response
        {
          $entityManger = $this->getDoctrine()->getManager() ;
          $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy($arrayName = array('Matricule' => $mat ));
          if(!$voitures)
          {
            throw $this->createNotFoundExeption(
              'pas de voiture avec la matricule'.$mat
            );
 
          }
 $voitures[0]->setDisponibilite(0);
 $entityManger->flush();
 return $this->redirectToRoute('createcnt');
 }
 
 /**
  * @Route("/rendre/{mat}", name="rendrebaymat")
  */
 public function rendre(string $mat, Request $request): Response
 {
   $entityManger = $this->getDoctrine()->getManager() ;
   $voitures = $this->getDoctrine()->getRepository(Voiture::class)->findBy($arrayName = array('Matricule' => $mat ));
   if(!$voitures)
   {
     throw $this->createNotFoundExeption(
       'pas de voiture avec la matricule'.$mat
     );
 
   }
 $voitures[0]->setDisponibilite(1);
 $entityManger->flush();
 return $this->redirectToRoute('voiture');
 }
}