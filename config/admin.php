<?php

return [
    'role'		=> [
        'super_role' => [
            'role' 			=> 'admin',
            'owner'			=> 'admin',
            'description'		=> 'super role of the system',
        ],
        'default_role' => [
            'role'	=> 'default',
            'owner'	=> 'admin',
            'description'	=> '',
        ],
        'super_role_id' => [
            1,
        ],
        'attr'	=> [
            'id'			=> 'ID',
            'role'			=> '角色名',
            'description'		=> '描述',
        ],
    ],
    'group'		=> [
        'attr'	=> [
            'id'			=> 'ID',
            'groupname'		=> '组名',
            'description'		=> '描述',
        ],
    ],
    'user' => [
        'attr' => [
            'id'			=> 'ID',
            'username'		=> '用户名',
            'nickname'		=> '显示名',
            'email'			=> '电邮',
            'mobile'		=> '手机',
            'groupname'		=> '部门',
            'status'		=> '状态',
        ],
        'status' => [
            '0'	    => '锁定',
            '1'	    => '正常',
            '-1'    => '删除',
        ],
        'super_user' => [
            'username' 		=> 'admin',
            'id'			=> '0',
        ],
    ],
    'modules' => [
        'attr' => [
            'id'			=> 'ID',
            'module'		=> '模块名称',
            'module_cn'		=> '模块中文名称',
            'action'        => '模块子项',
            'action_cn'		=> '模块子项中文名称',
            'module_type'   => '模块类型',
            'description'   => '模块描述',
            'order_by'		=> '排序',
            'gname'		    => '模块子项分组名',
        ]
    ],
    'module' => [
        'static'	=>	'0',
        'dynamic'	=>	'1',	//for box
        'company'	=>	'2',    //公司
    ],
    'showusers' => [
        'attr' => [
            'uid'           => '用户ID',
            'username'      => '用户名',
            'nickname'		=> '用户昵称',
            'sex'           => '性别',
            'job'		    => '职业',
            'showskill'     => '直播技能',
            'identity'		=> '身份',
            'status'        => '状态',
            'ctime'		    => '创建时间',
        ],
        'userattr' => [
            'uid'           => '用户ID',
            'username'      => '用户名',
            'nickname'		=> '用户昵称',
            'sex'           => '性别',
            'job'		    => '职业',
            'showskill'     => '直播技能',
            'identity'		=> '身份',
            'status'        => '状态',
            'ctime'		    => '创建时间',
            'birthday'      => '生日',
            'constellation' => '星座',
            'hobby'		    => '爱好',
            'weibo'		    => '微博',
            'loginsource'   => '用户登录来源',
            'level'		    => '等级',
            'pic'		    => '头像',
            'bpic'		    => '封面',
        ],
        'userexattr' => [
            'score'             => '积分',
            'enum'              => '经验值',
            'attnum'		    => '关注数',
            'fansnum'           => '粉丝数',
            'consumes'		    => '礼物送出数',
            'shownum'           => '节目数',
            'colnum'		    => '剩余钻石数',
            'coldnum'           => '消费钻石数',
            'jnum'		        => '剩余红豆数',
            'dnum'		        => '消费红豆数',
            'ojnum'		        => '副账户剩余红豆数',
            'odnum'		        => '副账户消费红豆数',
            'valnum'		    => '总获得礼物价值钻石数',
            'lnum'		        => '赞数',
            'useripaddr'        => '最后登录IP',
        ]
    ],

    /* option of controller */
    'user_account' 	=> [
        'per_page'	=>	20,
    ],
    'user_group' 	=> array(
        'per_page'	=>	20,
    ),
    'module_list'=> array(
        'per_page'	=>	20,
    ),
    'show_user'=> array(
        'per_page'	=>	20,
    ),
    'show_anchor'=> array(
        'per_page'	=>	20,
    ),
    'edit'=> array(
        'per_page'	=>	20,
    ),
    'examine'=> array(
        'per_page'	=>	20,
    ),
    /* option of controller end */
];
