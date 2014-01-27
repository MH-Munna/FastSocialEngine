<div class="filtr">
    <div class="active my">
        Мое видео<span id="count_videous">{$count_video}</span>
    </div>
    <div class="all">
        <p>Все видео <span>210</span></p>
    </div>
    <div class="new"><img onclick="load_video()" src="/images/profile/add_video.png" /></div>
</div>
<div class="clr"></div>
<div class="elements" id="all_videos">
            {foreach from=$videos item=item key=key}
            <div class="gr" onclick="open_video('{$item.id}')">
                <img class="pl" src="/images/profile/play.png" />
                <img width="197" height="98" src="{$item.img}" />

                <p>
                    <a href="">{$item.name}</a>
                </p>
            </div>
            {/foreach}
</div>
    <div class="clr"></div>
