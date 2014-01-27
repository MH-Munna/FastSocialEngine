{foreach item=con from=$search_result}
    {if $con.type eq 'people'}
        <div>
        {include file='people/people_item.tpl' profile_id=$con.info.id profile_ch_fname=$con.info.ch_fname profile_ch_lname=$con.info.ch_lname profile_avatar_url50x50=$con.info.avatar_url50x50}
        </div>
    {/if}
{foreachelse}
    Ничего не найдено
{/foreach}