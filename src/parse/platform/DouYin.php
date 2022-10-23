<?php

namespace BlsaCn\ParseVideoUrl\parse\platform;

use BlsaCn\ParseVideoUrl\parse\Base;
use BlsaCn\ParseVideoUrl\parse\PlatformInterface;

class DouYin extends Base implements PlatformInterface
{
    public function parseUrl(string $url): PlatformInterface
    {
        $newUrl = $this->redirect($url);
        preg_match('/.*?\/video\/(\d+)\/.*?/', $newUrl, $matches);
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

        $requestUrl = 'https://www.iesdouyin.com/web/api/v2/aweme/iteminfo/?item_ids=' . $this->videoId;
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

        $item = $this->data['item_list'][0];

        $this->result['authorName'] = $item['author']['nickname'] ?? '';
        $this->result['authorAvatar'] = $item['author']['avatar_larger']['url_list'][0] ?? '';
        $this->result['title'] = $item['desc'] ?? '';

        $originUrl = str_replace('/playwm/', '/play/', $item['video']['play_addr']['url_list'][0]);
        $this->result['videoUrl'] = $this->redirect($originUrl);

        $this->result['coverUrl'] = $item['video']['origin_cover']['url_list'][0] ?? '';
        $this->result['commentNum'] = $item['statistics']['comment_count'] ?? 0;
        $this->result['likeNum'] = $item['statistics']['digg_count'] ?? 0;

        return $this->result;
    }
}
