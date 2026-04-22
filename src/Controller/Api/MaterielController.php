<?php

namespace App\Controller\Api;

use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class MaterielController extends AbstractController
{
    #[Route('/api/materiel', name: 'api_materiel', methods: ['GET'])]
    public function index(MaterielRepository $materielRepository): JsonResponse
    {
        $materiels = $materielRepository->findAll();

        $data = [];

        foreach ($materiels as $materiel) {
            $data[] = [
                'id' => $materiel->getId(),
                'nom' => $materiel->getNom(),
                'description' => $materiel->getDescription(),
                'prix' => $materiel->getPrix(),
            ];
        }

        return $this->json($data);
    }
}