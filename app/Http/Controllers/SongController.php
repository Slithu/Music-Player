<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Support\Facades\Http;

class SongController extends Controller
{
    public function fetchFromApi(Request $request)
    {
        // Przykład dla iTunes Search API
        $query = $request->input('query', 'pop'); // szukamy 'pop' jeśli brak query
        $response = Http::get('https://itunes.apple.com/search', [
            'term' => $query,
            'media' => 'music',
            'limit' => 10,
        ]);

        $results = collect($response->json()['results'])->map(function($item) {
            return [
                'title' => $item['trackName'] ?? 'Brak tytułu',
                'artist' => $item['artistName'] ?? 'Brak wykonawcy',
                'album' => $item['collectionName'] ?? null,
                'file_path' => $item['previewUrl'] ?? null,
                'cover_path' => $item['artworkUrl100'] ?? null,
            ];
        });

        return response()->json($results);
    }
}
