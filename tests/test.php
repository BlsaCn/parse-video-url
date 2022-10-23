<?php

use BlsaCn\ParseVideoUrl\parse\Parse;

include "../vendor/autoload.php";

// 根据url自动匹配对应的平台
// var_dump(Parse::byMsg("https://h5.pipix.com/s/MBxwbnj 羊会咩咩，鸭会嘎嘎，鸡会什么"));

// 皮皮虾
// var_dump(Parse::PiPiXia('https://h5.pipix.com/s/MBxwbnj'));

// 抖音
// var_dump(Parse::DouYin('https://v.douyin.com/MhPKjN2/'));

// 西瓜
// var_dump(Parse::XiGua('https://v.ixigua.com/Mm8mnoy'));

// 头条
// var_dump(Parse::TouTiao('https://m.toutiao.com/is/Mu13Xqu/'));

// 哔哩哔哩
var_dump(Parse::BiLiBiLi('https://b23.tv/3uPg39'));
