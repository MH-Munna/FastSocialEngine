    {if $friendship eq 'yes'}
        <p>Ваш друг. <a href="#" onclick="del_friend({$opened_profile_info.id}); return false;">Удалить из друзей</a></p>
    {/if}
    {if $friendship eq 'no'}
        <ul class="menu">
        <li><a href="#" onclick="add_friend({$opened_profile_info.id}); return false;">Добавить в друзья</a></li>
        </ul>
    {/if}
    {if $friendship eq 'in'}
        <ul class="menu">
        <li><a href="#" onclick="add_friend({$opened_profile_info.id}); return false;">Подвердить заявку</a></li>
        </ul>
    {/if}
    {if $friendship eq 'out'}
        <p>Заявка в друзья ожидает подтверждения</p>
    {/if}