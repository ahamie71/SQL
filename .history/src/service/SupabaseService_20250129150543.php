<?php
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
        // Construire l'URL de la requête vers Supabase avec les filtres
        $url = "{$this->url}/rest/v1/{$table}";

        // Si des filtres sont fournis, les ajouter à l'URL sous forme de query params
        if (!empty($filters)) {
            // Utilisation de http_build_query pour formater les paramètres de manière correcte
            $queryString = http_build_query($filters);
            $url .= "?{$queryString}";
        }

        // Envoi de la requête à Supabase
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
