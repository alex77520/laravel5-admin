<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo Config::get('option.global.title');?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php echo Config::get('option.global.description');?>">

        <!-- styles & scripts -->
        <link rel="shortcut icon" href="<?php echo Config::get('option.global.icon');?>" type="image/x-icon" />

{{--        <link href="{{ asset('css/reset-min.css') }}" rel="stylesheet" type="text/css" />--}}
        <!-- Bootstrap 3.3.6 -->
        <link href="{{ asset('css/bootstrap.min14ed.css') }}" rel="stylesheet" type="text/css" />
        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('js/lib/jquery.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('js/lib/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- bootbox 2.3.1 -->
        <script src="{{ asset('js/bootbox.min.js') }}" type="text/javascript"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jquery.corner 2.12 -->
        <script>
            //解决jq低版本 msie
            jQuery.browser={};
            (function(){
                jQuery.browser.msie=false;
                jQuery.browser.version=0;
                if(navigator.userAgent.match(/MSIE ([0-9]+)./)){
                    jQuery.browser.msie=true;
                    jQuery.browser.version=RegExp.$1;
                }
            })();

            //csrf 全局变量
            var kw_csrf = "{{ csrf_token()  }}";
        </script>
        <script src="{{ asset('js/lib/select2/select2.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.corner.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/browser.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/base.js') }}" type="text/javascript"></script>
        <link href="{{ asset('css/base.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/supplement.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('js/backtotop.js') }}" type="text/javascript"></script>
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>

