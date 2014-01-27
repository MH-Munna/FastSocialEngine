<!DOCTYPE html>
<html>
<head>
    <title>AvatoriaRu</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
    <link data-turbolinks-track="true" href="{$i.base_url}/assets/application.css?body=1" media="screen" rel="stylesheet" />
    <link data-turbolinks-track="true" href="{$i.base_url}/assets/cabinet_style.css?body=1" media="screen" rel="stylesheet" />
    <link data-turbolinks-track="true" href="{$i.base_url}/assets/ckeditor/contents.css" media="screen" rel="stylesheet" />
    <link data-turbolinks-track="true" href="{$i.base_url}/assets/ckeditor/skins/moono/editor.css" media="screen" rel="stylesheet" />

    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery_ujs.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery.mousewheel.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery.autosize.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/perfect-scrollbar.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery-ui-1.10.3.custom.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery-ui-i18n.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/turbolinks.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/application.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/chosen.jquery.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/jquery.ikSelect.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/owl.carousel.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/cabinet.js?body=1"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/ckeditor/ckeditor.js"></script>
    <script data-turbolinks-track="true" src="{$i.base_url}/assets/ckeditor/adapters/jquery.js"></script>

    <script data-turbolinks-track="true" src="{$i.base_url}/assets/partners.js?body=1"></script>

    <link rel="stylesheet" href="{$i.base_url}/assets/colorbox/colorbox.css" />
    <script src="{$i.base_url}/assets/colorbox/jquery.colorbox-min.js"></script>
    <script src="{$i.base_url}/js/common.js"></script>
    <script src="{$i.base_url}/js/photo.js"></script>
    <script src="{$i.base_url}/js/apps.js"></script>

    <!-- AudioJS -->
    <script src="{$i.base_url}/js/profile/audio/audio.min.js"></script>

    <!-- noty -->
    <script type="text/javascript" src="{$i.base_url}/js/profile/noty/jquery.noty.js"></script>
    <script type="text/javascript" src="{$i.base_url}/js/profile/noty/layouts/bottomLeft.js"></script>
    <script type="text/javascript" src="{$i.base_url}/js/profile/noty/themes/default.js"></script>
    <!-- themes -->
    <link rel="stylesheet" type="text/css" href="{$i.base_url}/css/profile/noty/buttons.css"/>


    <meta content="authenticity_token" name="csrf-param" />
    <meta content="4m/ejPtT0LxQzHvkM9i/JH3gfc+go2dMD+xTHZw6mzw=" name="csrf-token" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=cyrillic' rel='stylesheet' type='text/css'>

    <link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=cyrillic' rel='stylesheet' type='text/css'>
    <!--[if lt IE 9]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <style>
        .audiojs { height: 22px; width: 100%; background: #404040;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #444), color-stop(0.5, #555), color-stop(0.51, #444), color-stop(1, #444));
            background-image: -moz-linear-gradient(center top, #444 0%, #555 50%, #444 51%, #444 100%);
            -webkit-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); -moz-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3);
            -o-box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); box-shadow: 1px 1px 8px rgba(0, 0, 0, 0.3); }
        .audiojs .play-pause { width: 15px; height: 20px; padding: 0px 8px 0px 0px; }
        .audiojs p { width: 25px; height: 20px; margin: -3px 0px 0px -1px; }
        .audiojs .scrubber { background: #5a5a5a; width: 500px; height: 10px; margin: 5px; }
        .audiojs .progress { height: 10px; width: 0px; background: #ccc;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #ccc), color-stop(0.5, #ddd), color-stop(0.51, #ccc), color-stop(1, #ccc));
            background-image: -moz-linear-gradient(center top, #ccc 0%, #ddd 50%, #ccc 51%, #ccc 100%); }
        .audiojs .loaded { height: 10px; background: #000;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #222), color-stop(0.5, #333), color-stop(0.51, #222), color-stop(1, #222));
            background-image: -moz-linear-gradient(center top, #222 0%, #333 50%, #222 51%, #222 100%); }
        .audiojs .time { float: left; height: 25px; line-height: 25px; }
        .audiojs .error-message { height: 24px;line-height: 24px; }
    </style>
</head>
<body>