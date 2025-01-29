<?php

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

    public function fetchData(string $table)
    {
        $response = $this->client->request('GET', "{$this->url}/rest/v1/{$table}", [
            'headers' => [
                'apikey' => $this->key,
                'Authorization' => 'Bearer ' . $this->key,
                'Content-Type' => 'application/json',
            ],
        ]);

        // Retourne les données de la table sous forme de tableau
        return $response->toArray();
    }

   
}
