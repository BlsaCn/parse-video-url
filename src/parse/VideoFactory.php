<?php

namespace BlsaCn\ParseVideoUrl\parse;

use DomainException;

class VideoFactory
{
    /**
     * 通过工厂模式拿到实例
     *
     * @param string $platform 视频平台标识
     *
     * @return PlatformInterface
     */
    public static function getInstance(string $platform): PlatformInterface
    {
        if (!in_array($platform, array_keys(Vars::$urlMap))) {
            throw new DomainException('没有匹配的视频平台', 1);
        }

        $class = "BlsaCn\\ParseVideoUrl\\parse\\platform\\$platform";
        return new $class();
    }
}
