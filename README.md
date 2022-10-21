<h1>BlsaCn/parse-video-url</h1>
<p>

</p>

## 短视频去水印

集成了：皮皮虾、抖音等等

## 安装

~~~
composer require blsacn/parse-video-url
~~~

> PHP版本：7.3+

使用：(可以参考tests/test.php)
==

    未知平台：Parse::byMsg($msg)
    皮皮虾：Parse::PiPiXia($url);
    抖音：Parse::DouYin($url);

成功返回

```
[
    'authorName' => '',  // 作者名称
    'authorAvatar' => '',// 作者头像地址
    'title' => '',       // 视频标题
    'videoUrl' => '',    // 视频播放地址
    'coverUrl' => '',    // 视频封面地址
    'commentNum' => 0,   // 评论数量
    'starNum' => 0,      // 点赞数量
]

array(7) {
  ["authorName"]=>
  string(18) "爱母虾的大爷"
  ["authorAvatar"]=>
  string(83) "https://p3-ppx.byteimg.com/obj/tos-cn-i-8gu37r9deh/2d6e8a8c1a994001950c6e9598b155b4"
  ["title"]=>
  string(42) "羊会咩咩，鸭会嘎嘎，鸡会什么"
  ["videoUrl"]=>
  string(425) "http://v6-cdn-tos.ppxvod.com/3cb286b46e7e3ad3c954393889c55caf/6352b957/video/tos/cn/tos-cn-ve-0076/65827b50c65941a4a6eb3809aaea621a/?a=1319&ch=0&cr=0&dr=3&cd=0%7C0%7C0%7C0&cv=1&br=1588&bt=1588&cs=0&ds=3&eid=2048&ft=FIJbvNN6V~6wbLMFq8dzJLeOYZlcsY2Od2bL9RljtiZm&mime_type=video_mp4&qs=0&rc=Zjw6OWc2Nzk2OzlkNGdlZ0BpanFla2Q6ZnJyZzMzNGYzM0AtMzEwYWIzNjYxYF5jYWJiYSNuMWlhcjRfLTJgLS1kMWFzcw%3D%3D&l=202210212222530102120440390CD2DEDA"
  ["coverUrl"]=>
  string(183) "https://p3-ppx-sign.byteimg.com/tos-cn-p-0076/8151df2c97c0421596496e5b9900d339_1665892503~tplv-f3gpralwbh-logo.jpeg?x-expires=1697898173&x-signature=YmzTu4vXG7g%2BTFGkLQYH9W%2BeXF0%3D"
  ["commentNum"]=>
  int(306)
  ["starNum"]=>
  int(5193)
}
```

失败返回

```
array(0) {
}
```

