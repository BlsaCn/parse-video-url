<?php

namespace BlsaCn\ParseVideoUrl\parse;

class Vars
{
    public const PIPIXIA = 'PiPiXia';
    public const DOUYIN = 'DouYin';

    public static $urlMap = [
        self::PIPIXIA => [
            'domain' => 'h5.pipix.com',
            'pattern' => '/(https:\/\/h5.pipix.com\/s\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
        self::DOUYIN => [
            'domain' => 'v.douyin.com',
            'pattern' => '/(https:\/\/v.douyin.com\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
    ];
}
