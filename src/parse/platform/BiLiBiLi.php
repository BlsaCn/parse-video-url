<?php

namespace BlsaCn\ParseVideoUrl\parse\platform;

use BlsaCn\ParseVideoUrl\parse\Base;
use BlsaCn\ParseVideoUrl\parse\PlatformInterface;
use BlsaCn\ParseVideoUrl\parse\tools\UserAgent;

class BiLiBiLi extends Base implements PlatformInterface
{
    public function parseUrl(string $url): PlatformInterface
    {
        $content = $this->get($url);
        preg_match('/.*?__INITIAL_STATE__=(.*?);\(function\(\).*?/', $content, $matches);
        if (empty($matches[1])) {
            return $this;
        }

        $this->data = json_decode($matches[1], true);

        return $this;
    }

    public function parseId(): PlatformInterface
    {
        return $this;
    }

    public function result(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $item = $this->data;
        $this->result['authorName'] = $item['upData']['name'] ?? '';
        $this->result['authorAvatar'] = $item['upData']['face'] ?? '';
        $this->result['title'] = $item['videoData']['title'] ?? '';
        $this->result['videoUrl'] = $this->getVideoUrl($item['aid'], $item['videoData']['cid']);
        $this->result['coverUrl'] = $item['videoData']['pic'] ?? '';
        $this->result['commentNum'] = $item['videoData']['stat']['reply'] ?? 0;
        $this->result['likeNum'] = $item['videoData']['stat']['like'] ?? 0;

        return $this->result;
    }

    private function getVideoUrl($aid, $cid): string
    {
        $requestUrl = 'https://api.bilibili.com/x/player/playurl';
        $str = $this->get(
            $requestUrl,
            [
                'avid' => $aid,
                'cid' => $cid,
                'qn' => '',
                'otype' => 'json',
                'type' => 'mp4',
                'platform' => 'html5',
            ],
            [
                'Cookie' => '',
                'Referer' => 'https://m.bilibili.com/video/av84665662',
                'origin' => 'https://m.bilibili.com',
                'Host' => 'api.bilibili.com',
                'User-Agent' => UserAgent::IOS,
            ]
        );

        if (empty($str)) {
            return '';
        }
        $data = json_decode($str, true);

        return $data['data']['durl'][0]['url'] ?? '';
    }
}
