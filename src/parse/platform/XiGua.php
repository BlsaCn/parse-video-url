<?php

namespace BlsaCn\ParseVideoUrl\parse\platform;

use BlsaCn\ParseVideoUrl\parse\Base;
use BlsaCn\ParseVideoUrl\parse\PlatformInterface;
use BlsaCn\ParseVideoUrl\parse\tools\UserAgent;

class XiGua extends Base implements PlatformInterface
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
        // 此接口没有无水印地址
        $requestUrl = "https://m.365yg.com/i$this->videoId/info/";
        $str = $this->get($requestUrl);
        if (empty($str)) {
            return $this;
        }
        $this->data = json_decode($str, true);

        return $this;
    }

    public function result(): array
    {
        if (empty($this->data) || !$this->data['success']) {
            return [];
        }

        $item = $this->data['data'];
        $this->result['authorName'] = $item['media_user']['screen_name'] ?? '';
        $this->result['authorAvatar'] = $item['media_user']['avatar_url'] ?? '';
        $this->result['title'] = $item['title'] ?? '';
        $this->result['videoUrl'] = $this->getVideoUrl() ?: $item['url'];
        $this->result['coverUrl'] = $item['poster_url'] ?? '';
        $this->result['commentNum'] = $item['comment_count'] ?? 0;
        $this->result['likeNum'] = $item['digg_count'] ?? 0;

        return $this->result;
    }

    private function getVideoUrl()
    {
        $requestUrl = "https://www.ixigua.com/" . $this->videoId;
        $str = $this->get(
            $requestUrl,
            [],
            [
                'User-Agent' => UserAgent::WIN,
                'Cookie' => "MONITOR_WEB_ID=7143612877764527652; __ac_nonce=06354165e0031397cdbb2; __ac_signature=_02B4Z6wo00f01fMszzAAAIDAeGdU0ds5es3zDMuAAB-hLkcyw3fUcsBLTtRrE0F5G49ooKwZz6ndN47fnhZx9zSVC6fgul9Gm0gDXVB77WhH564acTz3U67bXgn2Ve2-vAbsBDgsLMUWo2ive3; _tea_utm_cache_1768={%22utm_source%22:%22copy_link%22%2C%22utm_medium%22:%22android%22%2C%22utm_campaign%22:%22client_share%22}; _tea_utm_cache_1300={%22utm_source%22:%22copy_link%22%2C%22utm_medium%22:%22android%22%2C%22utm_campaign%22:%22client_share%22}; _tea_utm_cache_2285={%22utm_source%22:%22copy_link%22%2C%22utm_medium%22:%22android%22%2C%22utm_campaign%22:%22client_share%22}; ixigua-a-s=1; tt_scid=1RzrmUQ51j8q5QQYOPq-5V6RvaJewfqGuGfAF6294SbxsJGjStTZsFiOEL.YpAp.3e2c; ttwid=1%7Ccu9m9yb45Ydazbt1ZywzV5oW-kcMjhLOL6wl3BCCLfw%7C1666455550%7C46d6198ce31b93fe21f5e4ead3928e9316c6a87ab6691c696d9eaf0e33ef665a;"
            ]
        );

        $pattern = '/"main_url":"(.*?)"/';
        preg_match($pattern, $str, $matches);
        if (!empty($matches) && isset($matches[1])) {
            return base64_decode($matches[1]);
        }

        return '';
    }
}
