<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Form\SoireeType;
use App\Repository\SoireeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class SoireeController extends AbstractController
{
    #[Route('/soiree', name: 'soiree_index')]
    public function index(SoireeRepository $repo): Response
    {
        return $this->render('soiree/index.html.twig', [
            'soirees' => $repo->findNextThree(),
        ]);
    }

    #[Route('/soiree/new', name: 'soiree_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $soiree = new Soiree();

        $form = $this->createForm(SoireeType::class, $soiree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($soiree);
            $em->flush();

            return $this->redirectToRoute('soiree_index');
        }

        return $this->render('soiree/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/soiree/{id}/edit', name: 'soiree_edit')]
    public function edit(Soiree $soiree, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(SoireeType::class, $soiree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('soiree_index');
        }

        return $this->render('soiree/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/soiree/{id}/delete', name: 'soiree_delete')]
    public function delete(Soiree $soiree, EntityManagerInterface $em): Response
    {
        $em->remove($soiree);
        $em->flush();

        return $this->redirectToRoute('soiree_index');
    }

}