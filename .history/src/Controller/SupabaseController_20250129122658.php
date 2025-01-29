<?


// src/Controller/SupabaseController.php
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
        // Appelle le service pour récupérer les données de la table
        $data = $supabaseService->fetchData($table);

        // Retourne les données en JSON
        return $this->json($data);
    }
}
