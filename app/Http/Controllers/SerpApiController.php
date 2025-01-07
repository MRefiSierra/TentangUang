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

        // Panggil API SerpApi
        $response = Http::get($this->baseUrl, [
            'api_key' => config('services.serpapi.key'),
            'engine' => 'google_finance',
            'q' => $query,
            'hl' => 'en', // Optional: setting language
            'nocache' => 'true', // Supaya mendapatkan data terbaru
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch data: ' . $response->body());
        }

        // Ambil data yang diperlukan dari response
        $data = $response->json();

        // Ambil summary data
        $stockData = $data['summary'] ?? [];

        // Ambil graph terakhir
        $latestGraphData = [];
        if (isset($data['graph']) && is_array($data['graph'])) {
            $latestGraphData = end($data['graph']); // Ambil elemen terakhir
        }

        // Format tanggal untuk 'last_updated'
        $lastUpdatedRaw = $latestGraphData['date'] ?? null;
        $lastUpdatedFormatted = null;
        if ($lastUpdatedRaw) {
            $dateTime = new \DateTime($lastUpdatedRaw);
            $lastUpdatedFormatted = $dateTime->format('d M Y, H:i'); // Format ramah pengguna
        }

        // Gabungkan data ke response
        return response()->json([
            'stock_code' => $stockData['stock'] ?? null,
            'stock_price' => $stockData['price'] ?? null,
            'daily_change' => $stockData['price_movement']['value'] ?? null,
            'percentage' => $stockData['price_movement']['percentage'] ?? null,
            'movement' => $stockData['price_movement']['movement'] ?? null,
            'latest_graph' => [
                'last_updated' => $lastUpdatedFormatted,
            ],
        ]);
    }
}
