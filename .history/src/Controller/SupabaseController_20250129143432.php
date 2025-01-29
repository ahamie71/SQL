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
    public function index(SupabaseService $supabaseService, string $table): Response
    {
        // Récupère les données depuis Supabase
        $data = $supabaseService->fetchData($table);

        // Affiche la page Twig avec les données
        return $this->render('supabase/index.html.twig', [
            'table' => $table,
            'data' => $data,
        ]);
    }
    #[Route('/supabase/insert/{table}', name: 'insert_supabase')]
    public function insertData(SupabaseService $supabaseService, string $table, Request $request): Response
    {
        // Exemple d'insertion, les données proviennent du corps de la requête
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ];

        // Appel à la méthode d'insertion du service
        $result = $supabaseService->insertData($table, $data);

        return $this->json($result); // Retourne la réponse en JSON
    }
}

