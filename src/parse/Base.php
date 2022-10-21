<?php

namespace BlsaCn\ParseVideoUrl\parse;

use BlsaCn\ParseVideoUrl\parse\tools\HttpRequest;

class Base
{
    use HttpRequest;

    // 视频解析后的id
    public $videoId = '';

    // 视频接口返回的数据
    public $data = [];

    // 最后封装的接口返回给用户
    public $result = [
        'authorName' => '',  // 作者名称
        'authorAvatar' => '',// 作者头像地址
        'title' => '',       // 视频标题
        'videoUrl' => '',    // 视频播放地址
        'coverUrl' => '',    // 视频封面地址
        'commentNum' => 0,   // 评论数量
        'starNum' => 0,      // 点赞数量
    ];
}
