<div class="b-block b-cabinet-wall__wrap b-cabinet-wall__wrap_groups">
    <div class="b-block b-cabinet-wall__groups-header">
        <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-all b-cabinet-wall__groups-active">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups" onclick="return groups_list_get_tab('userGroups')">
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Мои группы: {$op.info.i_members}</span>
            </a>
        </div>
        <div class="b-inline b-cabinet-wall__groups-my-all b-cabinet-wall__groups-my">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups" onclick="return groups_list_get_tab('available')">
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Все группы: {$i.gp.totalGroups}</span>
            </a>
        </div>
        <div class="b-inline b-cabinet-wall__groups-add-wrap">
            <a class="b-inline b-cabinet__chat-contact-list-button b-cabinet-wall__groups-add" onclick="return groups_list_create();">
                <span class="b-inline b-cabinet-wall__groups-add-plus"></span>
                <span class="b-inline b-participants__button-text b-cabinet-wall__groups-text">Создать группу</span>
            </a>
        </div>
    </div>
    <div class='b-cabinet-wall__photos' id="groups_tab_box">
        {include file='groups_tab/userGroups.tpl'}
    </div>
</div>