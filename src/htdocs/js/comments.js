//function add_comment(id,type,parent){
//    $.post('/comments/add.php',{
//        'id':id,
//        'type':type,
//        'user_id':window.viewProfileID,
//        'text':$('#'+type+'_text_editor').html(),
//        'parent':parent
//    },function(a){
//        insert_comm(type+'_'+id+'_container', a);
//    });
//}
//
//function insert_comm(element, html_comment){
//    $('#'+element).prepend(html_comment);
//}