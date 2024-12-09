<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class MarqueController extends AbstractController
{
    #[Route('/marques/new', name: 'marques_new')]
    public function new(Request $request, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager): Response
    {
        // Création de l'objet Marque
        $marque = new Marques();
        
        // Création du formulaire
        $form = $this->createFormBuilder($marque)
            ->add('titre')
            ->add('description')
            ->getForm();

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement dans la base de données
            $entityManager->persist($marque);  // Marque l'entité pour l'enregistrement
            $entityManager->flush();  // Applique les modifications à la base de données

            return $this->redirectToRoute('app_home');
        }

        // Rendu du formulaire
        return $this->render('marques/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    // Méthode pour modifier une marque
    #[Route('/marques/{titre}/edit', name: 'marques_edit')]
    public function edit(Request $request, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager, string $titre): Response
    {
        $marque = $marquesRepository->findOneBy(['Titre' => $titre]);

        if (!$marque) {
            throw $this->createNotFoundException('Marque non trouvée.');
        }

        $form = $this->createFormBuilder($marque)
            ->add('Titre')
            ->add('Description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($marque);  
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('marques/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer une marque
    #[Route('/marques/{titre}', name: 'marques_delete', methods: ['POST'])]
    public function delete(Request $request, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager, string $titre): Response
    {
        $marque = $marquesRepository->findOneBy(['Titre' => $titre]);

        if (!$marque) {
            throw $this->createNotFoundException('Marque non trouvée.');
        }

        if ($this->isCsrfTokenValid('delete' . $marque->getTitre(), $request->request->get('_token'))) {
            $entityManager->remove($marque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_home');
    }
}
