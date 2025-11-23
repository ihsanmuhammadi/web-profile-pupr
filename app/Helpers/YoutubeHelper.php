<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeHelper
{
    /**
     * Extract video ID from various YouTube URL formats
     */
    public static function extractVideoId($url)
    {
        if (empty($url)) {
            Log::warning('YouTubeHelper: Empty URL provided');
            return null;
        }

        Log::info('YouTubeHelper: Extracting video ID from URL', ['url' => $url]);

        // Format: youtube.com/live/VIDEO_ID
        if (preg_match('/youtube\.com\/live\/([a-zA-Z0-9_-]{5,})/', $url, $m)) {
            Log::info('YouTubeHelper: Video ID extracted (live)', ['video_id' => $m[1]]);
            return $m[1];
        }

        // Format: youtube.com/watch?v=VIDEO_ID
        if (preg_match('/[?&]v=([a-zA-Z0-9_-]{5,})/', $url, $m)) {
            Log::info('YouTubeHelper: Video ID extracted (watch)', ['video_id' => $m[1]]);
            return $m[1];
        }

        // Format: youtu.be/VIDEO_ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{5,})/', $url, $m)) {
            Log::info('YouTubeHelper: Video ID extracted (short)', ['video_id' => $m[1]]);
            return $m[1];
        }

        // Format: youtube.com/embed/VIDEO_ID
        if (preg_match('/embed\/([a-zA-Z0-9_-]{5,})/', $url, $m)) {
            Log::info('YouTubeHelper: Video ID extracted (embed)', ['video_id' => $m[1]]);
            return $m[1];
        }

        Log::warning('YouTubeHelper: Could not extract video ID', ['url' => $url]);
        return null;
    }

    /**
     * Get video data from YouTube API
     */
    public static function getVideoData($videoId)
    {
        $apiKey = env('YOUTUBE_API_KEY');

        // Validation
        if (!$apiKey) {
            Log::error('YouTubeHelper: YOUTUBE_API_KEY not set in .env');
            return null;
        }

        if (!$videoId) {
            Log::warning('YouTubeHelper: No video ID provided');
            return null;
        }

        Log::info('YouTubeHelper: Fetching video data', ['video_id' => $videoId]);

        try {
            $response = Http::timeout(10)->get("https://www.googleapis.com/youtube/v3/videos", [
                'id' => $videoId,
                'part' => 'snippet,statistics',
                'key' => $apiKey
            ]);

            // Log response for debugging
            Log::info('YouTubeHelper: API Response', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if (!$response->successful()) {
                Log::error('YouTubeHelper: API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                return null;
            }

            $data = $response->json();

            if (empty($data['items'])) {
                Log::warning('YouTubeHelper: No video found', ['video_id' => $videoId]);
                return null;
            }

            $video = $data['items'][0];

            $result = [
                'videoId'      => $videoId,
                'title'        => $video['snippet']['title'] ?? 'No Title',
                'channel'      => $video['snippet']['channelTitle'] ?? 'Unknown Channel',
                'views'        => $video['statistics']['viewCount'] ?? 0,
                'published_at' => $video['snippet']['publishedAt'] ?? now()->toISOString()
            ];

            Log::info('YouTubeHelper: Video data retrieved successfully', $result);

            return $result;

        } catch (\Exception $e) {
            Log::error('YouTubeHelper: Exception occurred', [
                'message' => $e->getMessage(),
                'video_id' => $videoId
            ]);
            return null;
        }
    }

    /**
     * Get video thumbnail URL
     */
    public static function getThumbnail($videoId, $quality = 'maxresdefault')
    {
        if (!$videoId) {
            return null;
        }

        // Available qualities: default, mqdefault, hqdefault, sddefault, maxresdefault
        return "https://img.youtube.com/vi/{$videoId}/{$quality}.jpg";
    }

    /**
     * Get embed URL
     */
    public static function getEmbedUrl($videoId, $autoplay = false, $controls = true)
    {
        if (!$videoId) {
            return null;
        }

        $params = [];
        if ($autoplay) {
            $params[] = 'autoplay=1';
        }
        if (!$controls) {
            $params[] = 'controls=0';
        }

        $queryString = !empty($params) ? '?' . implode('&', $params) : '';
        return "https://www.youtube.com/embed/{$videoId}{$queryString}";
    }

    /**
     * Format view count
     */
    public static function formatViews($views)
    {
        if ($views >= 1000000) {
            return round($views / 1000000, 1) . 'M';
        } elseif ($views >= 1000) {
            return round($views / 1000, 1) . 'K';
        }
        return $views;
    }

    
}
