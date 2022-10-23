<?php

namespace BlsaCn\ParseVideoUrl\parse\platform;

use BlsaCn\ParseVideoUrl\parse\Base;
use BlsaCn\ParseVideoUrl\parse\PlatformInterface;

class PiPiXia extends Base implements PlatformInterface
{
    public function parseUrl(string $url): PlatformInterface
    {
        $newUrl = $this->redirect($url);
        preg_match('/.*?\/item\/(\d+)\?.*?/', $newUrl, $matches);
        if (empty($matches)) {
            return $this;
        }

        $this->videoId = $matches[1];
        return $this;
    }

    public function parseId(): PlatformInterface
    {
        if (empty($this->videoId)) {
            return $this;
        }
        $requestUrl =
            'https://is.snssdk.com/bds/cell/detail/?cell_type=1&aid=1319&app_name=super&cell_id=' . $this->videoId;
        $str = file_get_contents($requestUrl);
        if (empty($str)) {
            return $this;
        }
        $this->data = json_decode($str, true);

        return $this;
    }

    public function result(): array
    {
        if (empty($this->data)) {
            return [];
        }

        $item = $this->data['data']['data']['item'];
        $this->result['authorName'] = $item['author']['name'] ?? '';
        $this->result['authorAvatar'] = $item['author']['avatar']['download_list'][1]['url'] ?? '';
        $this->result['title'] = $item['content'] ?? '';
        $this->result['videoUrl'] = $item['origin_video_download']['url_list'][0]['url'] ?? '';
        $this->result['coverUrl'] = $item['cover']['download_list'][0]['url'] ?? '';
        $this->result['commentNum'] = $item['stats']['comment_count'] ?? 0;
        $this->result['likeNum'] = $item['stats']['like_count'] ?? 0;

        return $this->result;
    }
}
