
@include('layouts.common_header')
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--leftBar-->
        @include('layouts.leftBar')
        <!-- right part -->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!-- rightTop -->
            @include('layouts.rightTop')
            <!-- rightTag -->
            @include('layouts.rightTag')
            <!-- rightContent -->
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="home/welcome" frameborder="0" data-id="admin_index" seamless>
                    @yield('content')
                </iframe>
            </div>
            <!-- rightContentFooter -->
            @include('layouts.rightContentFooter')
        </div>
        <!-- right part  end-->

        <!-- right sidebar -->
            <!-- nothing then -->
        <!-- right sidebar end-->
    </div>
    @include('layouts.common_footer')
</body>
