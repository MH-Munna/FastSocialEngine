<object width="{$app_config.width}" height="{$app_config.height}" align="middle" id="game"
        codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"
        classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
    <embed width="{$app_config.width}" height="{$app_config.height}" align="middle"
           pluginspage="http://www.macromedia.com/go/getflashplayer"
           type="application/x-shockwave-flash"
           allowscriptaccess="always"
           name="game"
           bgcolor=""
           salign="lt"
           flashvars="api_url=http%3A%2F%2Fapi.avatoria.com%2F&apps_id={$app_config.app_info.id}&viewer_id={$u.info.id}"
           quality="best"
           menu="false"
           wmode="window"
           src="{$app_config.url}"
           id="flashfirebug_1377212945541"
           allowfullscreen="true"
           allownetworking="all">
        <param name=”flashvars” value=”api_url=http%3A%2F%2Fapi.avatoria.ru%2F&apps_id={$app_config.app_info.id}&viewer_id={$u.info.id}&” />
        <param name="allowFullScreen" value="true">
        <param name="AllowNetworking" value="all">
</object>