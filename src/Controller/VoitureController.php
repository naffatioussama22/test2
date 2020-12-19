<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VoitureType;
use Symfony\Component\HttpFoundation\Request;

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
	

}
