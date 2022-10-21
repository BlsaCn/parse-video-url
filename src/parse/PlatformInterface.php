<?php

namespace BlsaCn\ParseVideoUrl\parse;

interface PlatformInterface
{
    /**
     * 解析url，提取视频id
     *
     * @param string $url
     *
     * @return PlatformInterface
     */
    public function parseUrl(string $url): PlatformInterface;

    /**
     * 通过视频id，请求获取数据
     *
     * @return PlatformInterface
     */
    public function parseId(): PlatformInterface;

    /**
     * 封装返回数据
     *
     * @return array
     */
    public function result(): array;
}
