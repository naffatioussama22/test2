<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CurrentHourController extends AbstractController
{
    /**
    *@Route("/")
     *@Route("/current/hour", name="current_hour")
     */
    public function index()
    {
        //$nom =$request->get('nom');
		$hour = date("h:i:sa");
        return $this->render('current_hour/index.html.twig', [
            'time' => $hour,
        ]);
    }
}