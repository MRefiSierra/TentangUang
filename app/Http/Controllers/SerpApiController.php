<?php

namespace App\Http\Controllers;

use App\Services\SerpApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SerpApiController extends Controller
{
    public function __construct(protected SerpApiService $serpApiService) {}

    protected $baseUrl = 'https://serpapi.com/search.json';
    public function getStockData(Request $request)
    {
        // Ambil query dari URL (misalnya ?query=BBRI)
        $query = $request->query('query');

        // Cek kalau query nggak ada
        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $response = Http::get($this->baseUrl, [
            'api_key' => config('services.serpapi.key'),
            'engine' => 'google_finance',
            'q' => $query,
            'hl' => 'en',  // Optional: setting language
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch data: ' . $response->body());
        }

        // Ambil data yang diperlukan dari response
        $data = $response->json();

        // Cek apakah data ada di summary
        $stockData = $data['summary'] ?? [];

        return [
            'stock_code' => $stockData['stock'] ?? null,
            'stock_price' => $stockData['price'] ?? null,
            'daily_change' => $stockData['price_movement']['value'] ?? null,
            'percentage' => $stockData['price_movement']['percentage'] ?? null,
            'movement' => $stockData['price_movement']['movement'] ?? null,
        ];
        // return($response->json());

    }
}
