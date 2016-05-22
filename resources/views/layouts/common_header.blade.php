
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="听音乐，用酷我">
    <meta name="keywords" content="听音乐，用酷我">

    <!-- style start -->
    <link href="{{ asset('css/bootstrap.min14ed.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/font-awesome.min93e3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.min862f.css') }}" rel="stylesheet" type="text/css" />
    <!-- style end -->
    <script>
        var kw_csrf = "{{ csrf_token()  }}";
    </script>

</head>