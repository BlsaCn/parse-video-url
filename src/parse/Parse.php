<?php

namespace BlsaCn\ParseVideoUrl\parse;

use BlsaCn\ParseVideoUrl\parse\platform\BiLiBiLi;
use BlsaCn\ParseVideoUrl\parse\platform\DouYin;
use BlsaCn\ParseVideoUrl\parse\platform\PiPiXia;
use BlsaCn\ParseVideoUrl\parse\platform\TouTiao;
use BlsaCn\ParseVideoUrl\parse\platform\XiGua;
use DomainException;

/**
 * @method static PiPiXia PiPiXia(string $url)      皮皮虾
 * @method static DouYin DouYin(string $url)        抖音
 * @method static XiGua XiGua(string $url)          西瓜
 * @method static TouTiao TouTiao(string $url)      头条
 * @method static BiLiBiLi BiLiBiLi(string $url)    哔哩哔哩
 */
class Parse
{
    /**
     * 解析消息
     *
     * @param string $msg 包含url的消息
     */
    public static function byMsg(string $msg): array
    {
        $platform = $url = '';
        foreach (Vars::$urlMap as $k => $item) {
            preg_match($item['pattern'], $msg, $matches);
            if ($matches && isset($matches[1])) {
                $platform = $k;
                $url = $matches[0];
                break;
            }
        }
        if (empty($platform) || empty($url)) {
            throw new DomainException('没有匹配的视频平台', 1);
        }

        return VideoFactory::getInstance($platform)->parseUrl($url)->parseId()->result();
    }

    /**
     * 已知平台和url解析
     *
     * @param string $class
     * @param array  $params
     *
     * @return array
     */
    public static function __callStatic(string $class, array $params)
    {
        $url = trim($params[0]);
        $pattern = '/^(http|https):\/\/([0-9a-zA-Z_]+.)?([0-9a-zA-Z_]+)\.(tv|com|cn|net|cc|com.cn|org).*?/';
        if (!preg_match($pattern, $url)) {
            throw new DomainException('不是url，url验证失败', 1);
        }

        return VideoFactory::getInstance($class)->parseUrl($url)->parseId()->result();
    }
}
