<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Video;

class GetVideosController extends Controller
{
    
    public function index()
    {
        $videos = Video::all();

        return view('videos.index', compact('videos'));
    }

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

        if ($response->successful()) {
            $data = $response->json();
            $videos = $data['items'];
    
            $videoData = [];
        
            foreach ($videos as $video) {
                $videoData[] = [
                    'title' => $video['snippet']['title'],
                    'description' => $video['snippet']['description'],
                    'video_id' => $video['id']['videoId'],
                    'video_url' => 'https://www.youtube.com/watch?v=' . $video['id']['videoId'],
                    'published_at' => $video['snippet']['publishedAt'],
                ];
            }

            return response()->json($videoData);
        }else {
            return response()->json(['error' => 'Erro na solicitação para o YouTube API']);
        }
    }
}