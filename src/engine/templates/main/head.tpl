<!DOCTYPE html>
<html>
<head>
    <title>AvatoriaRu</title>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
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