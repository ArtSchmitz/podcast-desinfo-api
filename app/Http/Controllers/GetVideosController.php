<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Video;
use App\Models\Aderiva;
use App\Models\SacoCheio;
use App\Models\DesinfoInfo;
use App\Models\AderivaInfo;
use App\Models\SacoCheioInfo;

class GetVideosController extends Controller
{
    public $apiKey;
    public $desinfoId = 'UC6Y5eAyPvXRkrDlgruro3CA';
    public $aderivaId = 'UCeg3XXEiFL2Zr3HcfNPUVzg';
    public $sacocheioId = 'UCEi4mIXHbqrEGsLoywqKi5g';

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
                    'video_url' => $video['id']['videoId'],
                ];
            }

            $model::insert($videoData);

            return response()->json($videoData);
        } else {
            return response()->json(['error' => 'Erro na solicitação para o YouTube API']);
        }
    }

    public function getVideosInfo($channelId, $model)
    {
        $channelName = $channelId;

        $channel = $model::where('channel_name', $channelName)->first();

        if ($channel) {
            return response()->json(['channel_name' => $channel->channel_name]);
        } else {
            return response()->json(['message' => 'O canal não foi encontrado.'], 404);
        }
    }

    public function getVideosDesinfo()
    {
        return $this->getVideos($this->desinfoId, Video::class);
    }

    public function getVideosAderiva()
    {
        return $this->getVideos($this->aderivaId, Aderiva::class);
    }

    public function getVideosSacoCheio()
    {
        return $this->getVideos($this->aderivaId, SacoCheio::class);
    }

    public function getVideosInfoDesinfo()
    {
        return $this->getVideosInfo('Podcast Desinformação', DesinfoInfo::class);
    }

    public function getVideosInfoAderiva()
    {
        return $this->getVideosInfo('Á Deriva Podcast', AderivaInfo::class);
    }

    public function getVideosInfoSacoCheio()
    {
        return $this->getVideosInfo('Saco Cheio Podcast', SacoCheioInfo::class);
    }
}