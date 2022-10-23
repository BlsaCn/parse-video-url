<?php

namespace BlsaCn\ParseVideoUrl\parse;

class Vars
{
    public const PIPIXIA = 'PiPiXia';
    public const DOUYIN = 'DouYin';
    public const XIGUA = 'XiGua';
    public const TOUTIAO = 'TouTiao';
    public const BILIBILI = 'BiLiBiLi';

    public static $urlMap = [
        self::PIPIXIA => [
            'domain' => 'h5.pipix.com',
            'pattern' => '/(https:\/\/h5.pipix.com\/s\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
        self::DOUYIN => [
            'domain' => 'v.douyin.com',
            'pattern' => '/(https:\/\/v.douyin.com\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
        self::XIGUA => [
            'domain' => 'v.ixigua.com',
            'pattern' => '/(https:\/\/v.ixigua.com\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
        self::TOUTIAO => [
            'domain' => 'm.toutiao.com',
            'pattern' => '/(https:\/\/m.toutiao.com\/is\/[0-9a-zA-Z]{7}\/?).*?/'
        ],
        self::BILIBILI => [
            'domain' => 'b23.tv',
            'pattern' => '/(https:\/\/b23.tv\/[0-9a-zA-Z]{6,7}\/?).*?/'
        ],
    ];
}
