<?php

return [

    //登录处理用哪个处理器来处理
    'login_process' => 'default',

    //图片的域名，必须以http://开头
    'sys_images_domain' => 'http://img.opcache.net',
    'sys_images_domain' => 'http://img.opcache.net',

    //后台访问域名，不用http://开头
//    'sys_admin_domain' => '60.28.204.157:8100',
//    'sys_admin_domain' => '60.28.204.157:8090',
    'sys_admin_domain' => 'testadmin.lianhong.com',

    //博客访问域名
    'sys_live_domain' => 'testwww.lianhong.com',


    //上传的路径，包括ueditor的上传路径也在这里定义了，因为修改了ueditor，重新加载了这个文件。
    'sys_upload_path' => __DIR__ . '/../../upload_path',

    //水印图片
    'sys_water_file' => __DIR__ . '/../storage/water/water.png',

    //不需要验证权限的功能，*号代表全部,module不能为*号
    'access_public' => [
        ['module' => 'foundation', 'class' => 'index', 'function' => '*'],
        ['module' => 'foundation', 'class' => 'user', 'function' => ['mpassword']],
        ['module' => 'foundation', 'class' => 'upload', 'function' => ['process']],
    ]
];
