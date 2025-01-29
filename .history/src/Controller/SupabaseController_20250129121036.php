<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class SupabaseService
{
    private string $supabaseUrl;
    private string $supabaseKey;
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient, string $supabaseUrl, string $supabaseKey)
    {
        $this->httpClient = $httpClient;
        $this->supabaseUrl = $supabaseUrl;
        $this->supabaseKey = $supabaseKey;
    }

    public function fetchData(string $table)
    {
        $response = $this->httpClient->request('GET', "{$this->supabaseUrl}/rest/v1/{$table}", [
            'headers' => [
                'apikey' => $this->supabaseKey,
                'Authorization' => "Bearer {$this->supabaseKey}",
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response->toArray();
    }
}
