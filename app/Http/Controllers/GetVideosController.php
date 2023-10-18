<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Video;
use App\Models\Aderiva;

class GetVideosController extends Controller
{
    public $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.api_key');
    }

    public function index()
    {
        $videos = Video::all();

        return view('videos.index', compact('videos'));
    }

    public function getVideos($channelId, $model)
    {
        $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
            'key' => $this->apiKey,
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
                    'video_url' => 'https://www.youtube.com/watch?v=' . $video['id']['videoId'],
                ];
            }

            $model::insert($videoData);

            return response()->json($videoData);
        }else {
            return response()->json(['error' => 'Erro na solicitação para o YouTube API']);
        }
    }

    public function getVideosDesinfo()
    {
        return $this->getVideos('UC6Y5eAyPvXRkrDlgruro3CA', Video::class);
    }

    public function getVideosAderiva()
    {
        return $this->getVideos('UCeg3XXEiFL2Zr3HcfNPUVzg', Aderiva::class);
    }
}