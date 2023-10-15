<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetVideosController extends Controller
{
    public function getVideosDesinfo()
    {
        $apiKey = config('services.youtube.api_key');
        $channelId = 'UC6Y5eAyPvXRkrDlgruro3CA';

        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'key' => $apiKey,
            'channelId' => $channelId,
            'part' => 'snippet',
            'order' => 'date',
            'maxResults' => 10,
        ]);

        $videos = $response->json(['items']);

        dd($response);
    }
}
