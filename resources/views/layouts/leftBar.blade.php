

        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <span><img alt="image" class="img-circle" src="imgs/p3.jpg" /></span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                               <span class="block m-t-xs"><strong class="font-bold">{{ $user->username  }}</strong></span>
                                <span class="text-muted text-xs block">{{ $user->nickname  }}<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="J_menuItem" href="form_avatar.html">修改头像</a>
                                </li>
                                <li><a class="J_menuItem" href="profile.html">个人资料</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ url('auth/logout') }}">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">H+
                        </div>
                    </li>

                    <!-- 模块导航栏 -->
                    <?php foreach($allStaticModule as $k=>$v):?>
                    <?php if ($v[0]->module_type == config('admin.module.company')) {continue;} ?>
                    <li><a href="#">
                            {{--<i class="fa fa-home"></i>--}}
                            <span class="nav-label"><?php echo $v[0]->module_cn;?></span>
                            <span class="fa arrow"></span>
                        </a>
                        <?php foreach ($v as $vv):?>
                        <?php if ($vv->module_type == config('admin.module.company')) {continue;} ?>
                        <ul class="nav nav-second-level">
                            <?php if(in_array($vv->id, $currentRolePermission)):?>
                                <li>
                                    <a class="J_menuItem" href="{{ url($v[0]->module.'/'.$vv->action) }}" target="_blank"><?php echo $vv->action_cn;?></a>
                                </li>
                            <?php  endif;?>
                        </ul>
                        <?php endforeach;?>
                    </li>
                    <?php endforeach;?>


                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->

