<?php

namespace App\Controller;

use App\Entity\Dj;
use App\Form\DjType;
use App\Repository\DjRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dj')]
final class DjController extends AbstractController
{
    #[Route(name: 'app_dj_index', methods: ['GET'])]
    public function index(DjRepository $djRepository): Response
    {
        return $this->render('dj/index.html.twig', [
            'djs' => $djRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dj_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dj = new Dj();
        $form = $this->createForm(DjType::class, $dj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dj);
            $entityManager->flush();

            return $this->redirectToRoute('app_dj_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dj/new.html.twig', [
            'dj' => $dj,
            'form' => $form->createView(), 
        ]);
    }

    #[Route('/{id}', name: 'app_dj_show', methods: ['GET'])]
    public function show(Dj $dj): Response
    {
        return $this->render('dj/show.html.twig', [
            'dj' => $dj,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dj_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dj $dj, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DjType::class, $dj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dj_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dj/edit.html.twig', [
            'dj' => $dj,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_dj_delete', methods: ['POST'])]
    public function delete(Request $request, Dj $dj, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dj->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dj);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dj_index', [], Response::HTTP_SEE_OTHER);
    }
}