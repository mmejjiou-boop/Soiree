<?php

namespace App\Controller;

use App\Entity\Soiree;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SoireeType;

final class SoireeController extends AbstractController
{
    //  LISTE DES SOIRÉES
    #[Route('/soirees', name: 'soiree_list')]
    public function list(EntityManagerInterface $em): Response
    {
        $soirees = $em->getRepository(Soiree::class)->findAll();

        return $this->json($soirees);
    }

    //  CRÉATION (EN DUR)
    #[Route('/soiree/creer', name: 'soiree_create')]
    public function create(EntityManagerInterface $em): Response
    {
        $soiree = new Soiree();

        $soiree->setTitre("Soirée mousse");
        $soiree->setDateSoiree(new \DateTimeImmutable('2026-05-01'));
        $soiree->setDateCreation(new \DateTimeImmutable());

        $em->persist($soiree);
        $em->flush();

        return $this->json([
            'message' => 'Soirée créée',
            'id' => $soiree->getId()
        ]);
    }

    //  LIRE UNE SOIRÉE
    #[Route('/soiree/{id}', name: 'soiree_read')]
    public function read(Soiree $soiree): Response
    {
        return $this->json($soiree);
    }

    //  MODIFIER UNE SOIRÉE
    #[Route('/soiree/{id}/update', name: 'soiree_update')]
    public function update(Soiree $soiree, EntityManagerInterface $em): Response
    {
        $soiree->setTitre("Soirée modifiée");

        $em->flush();

        return $this->json([
            'message' => 'Soirée mise à jour'
        ]);
    }

    //  SUPPRIMER UNE SOIRÉE
    #[Route('/soiree/{id}/supprimer', name: 'soiree_delete')]
    public function delete(Soiree $soiree, EntityManagerInterface $em): Response
    {
        $em->remove($soiree);
        $em->flush();

        return $this->json([
            'message' => 'Soirée supprimée'
        ]);
    }
    #[Route('/soirees', name: 'soiree_list')]
public function index(Request $request, EntityManagerInterface $em): Response
{
    $soirees = $em->getRepository(Soiree::class)->findAll();

    $soiree = new Soiree();

    $form = $this->createForm(SoireeType::class, $soiree);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $soiree->setDateCreation(new \DateTimeImmutable());

        $em->persist($soiree);
        $em->flush();

        return $this->redirectToRoute('soiree_list');
    }

    return $this->render('soiree/index.html.twig', [
        'soirees' => $soirees,
        'form' => $form->createView(),
    ]);
}
}