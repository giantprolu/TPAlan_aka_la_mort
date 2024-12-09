<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{category}', name: 'category_page')]
    public function show(string $category): Response
    {
        // Associer chaque catégorie à un dossier spécifique
        $categoryToFolder = [
            'voiture sport' => 'sport',
            'voiture classique' => 'classique',
            'marque TV' => 'TV',
        ];

        // Récupérer le dossier correspondant ou utiliser un dossier par défaut
        $folder = $categoryToFolder[$category] ?? 'default';

        // Chemin de l'image de fond
        $backgroundImage = "/photos/{$folder}/background.jpg";

        return $this->render('category/show.html.twig', [
            'category' => $category,
            'background_image' => $backgroundImage,
        ]);
    }
}
