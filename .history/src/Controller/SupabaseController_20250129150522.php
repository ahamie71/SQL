<?php
// src/Controller/SupabaseController.php
namespace App\Controller;

use App\Service\SupabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupabaseController extends AbstractController
{
    #[Route('/supabase/{table}', name: 'fetch_supabase')]
    public function index(SupabaseService $supabaseService, string $table, Request $request): Response
    {
        // Récupérer les critères de filtrage depuis l'URL (par exemple, ?field1=value1&field2=value2)
        $filters = $request->query->all();

        // Récupère les données de la table avec les filtres
        $data = $supabaseService->fetchData($table, $filters);

        // Affiche la page Twig avec les données
        return $this->render('supabase/index.html.twig', [
            'table' => $table,
            'data' => $data,
        ]);
    }

}

