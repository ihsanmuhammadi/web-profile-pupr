<?php

namespace App\Services;

class YouTubeService
{
    public function getVideoData($url)
    {
        $videoId = $this->extractVideoId($url);

        if (!$videoId) {
            return null;
        }

        // Contoh tanpa API, pakai dummy dulu
        return [
            'videoId'       => $videoId,
            'title'         => 'Judul Video',
            'channel'       => 'Nama Channel',
            'views'         => 10900,
            'published_at'  => '2025-03-24'
        ];
    }

    private function extractVideoId($url)
    {
        // Handle format live: https://www.youtube.com/live/ID?si=xxxx
        if (preg_match('/youtube\.com\/live\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return $m[1];
        }

        // Handle short format: https://youtu.be/ID
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $m)) {
            return $m[1];
        }

        // Handle normal watch URL: ?v=ID
        if (preg_match('/v=([a-zA-Z0-9_-]+)/', $url, $m)) {
            return $m[1];
        }

        return null;
    }
}
