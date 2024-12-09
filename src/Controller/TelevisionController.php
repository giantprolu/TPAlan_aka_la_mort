<?php

namespace App\Controller;

use App\Entity\Television;
use App\Repository\TelevisionRepository;
use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TelevisionController extends AbstractController
{
    #[Route('/televisions/new', name: 'television_new')]
    public function new(Request $request,TelevisionRepository $televisionRepository, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager,): Response
    {
        // Création de l'objet Television
        $television = new Television();
        
        // Création du formulaire
        $form = $this->createFormBuilder($television)
            ->add('Titre')
            ->add('Description')
            ->add('Couleur')
            ->add('Nom_fab')
            ->add('Diagonale')
            ->add('Dimensions')
            ->add('Poids')
            ->add('Marques', null, [
                'choice_label' => 'Titre',  // Affiche le titre des marques dans le formulaire
            ])
            ->getForm();

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement dans la base de données
            $entityManager->persist($television);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        // Rendu du formulaire
        return $this->render('televisions/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour modifier une télévision
    #[Route('/televisions/{id}/edit', name: 'television_edit')]
    public function edit(Request $request, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $television = $televisionRepository->find($id);

        if (!$television) {
            throw $this->createNotFoundException('Télévision non trouvée.');
        }

        $form = $this->createFormBuilder($television)
            ->add('Titre')
            ->add('Description')
            ->add('Couleur')
            ->add('Nom_fab')
            ->add('Diagonale')
            ->add('Dimensions')
            ->add('Poids')
            ->add('Marques', null, [
                'choice_label' => 'Titre',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($television);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('televisions/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer une télévision
    #[Route('/televisions/{id}/delete', name: 'television_delete', methods: ['POST'])]
    public function delete(Request $request, MarquesRepository $marquesRepository, EntityManagerInterface $entityManager, int $id): Response
    {
        $television = $televisionRepository->find($id);

        if (!$television) {
            throw $this->createNotFoundException('Télévision non trouvée.');
        }

        if ($this->isCsrfTokenValid('delete' . $television->getId(), $request->request->get('_token'))) {
            $entityManager->remove($television);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->redirectToRoute('app_home');
    }
}
