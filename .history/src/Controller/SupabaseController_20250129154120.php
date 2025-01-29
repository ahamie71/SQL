<?php
// src/Controller/SupabaseController.php
namespace App\Controller;

use App\Service\SupabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupabaseController extends AbstractController
{
    #[Route('/supabase/{table}', name: 'fetch_supabase')]
    public function index(SupabaseService $supabaseService, string $table, Request $request): Response
    {
        // Récupérer tous les filtres passés dans l'URL
        $filters = $request->query->all();

        // Récupère les données filtrées de la table
        $data = $supabaseService->fetchData($table, $filters);

        // Affiche la page Twig avec les données et les filtres actifs
        return $this->render('supabase/index.html.twig', [
            'table' => $table,
            'data' => $data,
            'filters' => $filters, // Pour afficher les filtres en cours dans le formulaire
        ]);
    }
}
