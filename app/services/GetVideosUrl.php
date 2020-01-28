<?php

namespace App\Services;
class GetVideosUrl

{
    public function getVideos()
    {
//        $videoList = $this->makeVideosList();
        $videoList = [
            'https://www.youtube.com/embed/5r3gdfJXRW4',
            'https://www.youtube.com/embed/cAkPM25h_A4',
            'https://www.youtube.com/embed/SVgHHTjRxZQ',
            'https://www.youtube.com/embed/Ro6Y8goh33c',
            'https://www.youtube.com/embed/e7Pg8a6jL1I',
            'https://www.youtube.com/embed/tM7MSaoVuI0',
            'https://www.youtube.com/embed/jmqKlNBjpWw',
            'https://www.youtube.com/embed/McnBFDnlg-E',
            'https://www.youtube.com/embed/EABb6rXiTD0',
            'https://www.youtube.com/embed/iuBcqfr_RnU'
        ];


        return $videoList;
    }

    private function makeVideosList()
    {
        $channelId = 'UCeTVoczn9NOZA9blls3YgUg';
        $maxResults = 10;
        $API_key = 'AIzaSyC2bzQLTHYtXj7R1TSvlZ-1HyY_OxB1xnI';
//        $API_key = 'AIzaSyD4rNOOOSNEZVG-BBDfexa4kdYl1dE1dgw';
        $listOfVideoKey = $this->getVideosKeyFromChanel($channelId, $maxResults, $API_key);
        $max = sizeof($listOfVideoKey);
        for ($i = 0; $i < $max; $i++) {
            $videoList[] = 'https://www.youtube.com/embed/' . $listOfVideoKey[$i];
        }

        return $videoList;
    }

    private function getVideosKeyFromChanel($channelId, $maxResults, $API_key)
    {
        $video_list = file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=' . $channelId . '&maxResults=' . $maxResults . '&key=' . $API_key . '');
        preg_match_all('/("videoId": ")(.+?(?="))/', $video_list, $matches);
        $videosKeyList = $matches[2];
        return $videosKeyList;
    }
}