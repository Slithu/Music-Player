<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JamendoController extends Controller
{
    private $client_id;

    public function __construct()
    {
        // Pobieramy client_id z pliku config/jamendo.php
        $this->client_id = config('jamendo.client_id');
    }

    /**
     * Pobiera utwory z Jamendo
     */
    public function getTracks(Request $request)
    {
        $limit = $request->input('limit', 10);

        $params = [
            'client_id' => $this->client_id,
            'format' => 'json',
            'limit' => $limit,
            'include' => 'musicinfo',
        ];

        $response = Http::get('https://api.jamendo.com/v3.0/tracks/', $params);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Nie udało się pobrać danych z Jamendo'
            ], 500);
        }

        $tracks = collect($response->json()['results'])->map(function($track) {
            return [
                'id' => $track['id'],
                'title' => $track['name'],
                'artist' => $track['artist_name'],
                'album' => $track['album_name'] ?? null,
                'file_path' => $track['audio'] ?? null,
                'cover_path' => $track['album_image'] ?? null,
                'tags' => $track['tags'] ?? [],
            ];
        });

        return response()->json($tracks);
    }
}
