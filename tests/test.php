<?php

use BlsaCn\ParseVideoUrl\parse\Parse;

include "../vendor/autoload.php";

// 未知平台
var_dump(Parse::byMsg("https://h5.pipix.com/s/MBxwbnj 羊会咩咩，鸭会嘎嘎，鸡会什么"));

// 皮皮虾
// var_dump(Parse::PiPiXia('https://h5.pipix.com/s/MBxwbnj 羊会咩咩，鸭会嘎嘎，鸡会什么'));

// 抖音
// var_dump(Parse::byMsg(' 2.02 pdn:/ 贡嘎雪山下挖虫草的人... https://v.douyin.com/MhPKjN2/ 复制此链接'));
// var_dump(Parse::DouYin(' 2.02 pdn:/ 贡嘎雪山下挖虫草的人... https://v.douyin.com/MhPKjN2/ 复制此链接'));
