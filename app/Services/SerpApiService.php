<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SerpApiService
{
    protected $baseUrl = 'https://serpapi.com/search';

    public function getGoogleFinanceData(string $query)
    {
        $response = Http::get($this->baseUrl, [
            'api_key' => config('services.serpapi.key'),
            'engine' => 'google_finance',
            'q' => $query,
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch data: ' . $response->body());
        }

        return $response->json();
    }
}
