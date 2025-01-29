
// src/Service/SupabaseService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SupabaseService
{
    private $client;
    private $url;
    private $key;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->url = $_ENV['SUPABASE_URL']; // URL de Supabase
        $this->key = $_ENV['SUPABASE_KEY']; // Clé API de Supabase
    }

    public function fetchData(string $table, array $filters = [])
    {
        // Construire l'URL de la requête vers Supabase
        $url = "{$this->url}/rest/v1/{$table}";

        // Vérifier s'il y a des filtres à appliquer
        if (!empty($filters)) {
            $queryParams = [];

            foreach ($filters as $key => $value) {
                if (!empty($value)) { // Évite d'ajouter des filtres vides
                    $queryParams[] = "{$key}=eq.{$value}";
                }
            }

            // Ajouter les filtres à l'URL
            if (!empty($queryParams)) {
                $url .= '?' . implode('&', $queryParams);
            }
        }

        // Envoi de la requête
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'apikey' => $this->key,
                'Authorization' => 'Bearer ' . $this->key,
                'Content-Type' => 'application/json',
            ],
        ]);

        // Retourne les données sous forme de tableau
        return $response->toArray();
    }
}
