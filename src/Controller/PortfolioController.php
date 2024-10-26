<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PortfolioController extends AbstractController
{
    #[Route('/', name: 'app_portfolio')]
    public function index(): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }

    #[Route('Competences', name: 'Skill')]
    public function skill(): Response
    {
        return $this->render('skill/index.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }
    
    #[Route('Profil', name: 'Profil')]
    public function profil(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'PortfolioController',
        ]);
    }
    
}


