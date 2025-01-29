<?php

namespace App\Controller;

use App\Service\SupabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SupabaseController extends AbstractController
{
    #[Route('/supabase/{table}', name: 'fetch_supabase')]
    public function index(SupabaseService $supabaseService, string $table): JsonResponse
    {
        $data = $supabaseService->fetchData($table);
        return $this->json($data);
    }
}

