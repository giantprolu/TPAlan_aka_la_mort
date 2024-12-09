<?php

namespace App\Controller;

use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MarquesRepository $marquesRepository): Response
    {
        $marques = $marquesRepository->findAll();

        return $this->render('home/index.html.twig', [
            'marques' => $marques,
        ]);
    }
}
