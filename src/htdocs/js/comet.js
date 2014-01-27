








function Messanger(dialog) {
    this.dialog=dialog;
    this.last=0;
    this.timeout=360;
    this.comet=0;
    this.no_start=0;
    var self=this;
    // забиваем в общий массив для того чтобы потом обрубать диалоги чтоб не висели соединения
    myOpenDialogs[dialog]=self;
    
    // функция остановки всего передачи данных. Закрытие диалога
    this.close=function(){
        self.no_start=1;
    }
    this.putMessage = function(obj_mess) {
        // если ИД не указан то выбираем его сами.
        // Чтобы пользователь отправивший сообщение срахуже получал его в свой чат.
        if(!obj_mess.user_name)obj_mess.user_name=user_info.ch_fname+' '+user_info.ch_lname;
        if(!obj_mess.user_id)obj_mess.user_id=user_info.id;
        if(!obj_mess.img)obj_mess.img=user_info.avatar_url_50x50;
        if(!obj_mess.ts){
            d=new Date();
            obj_mess.ts=[d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate(),d.getHours()+':'+(d.getMinutes()>9?d.getMinutes():'0'+d.getMinutes())+':'+(d.getSeconds()>9?d.getSeconds():'0'+d.getSeconds())];
        }
        if(!obj_mess.id){
            $.get('/dialog/getinfo.php?type=5',function(a){
                obj_mess.id=a;
                self.last = obj_mess.id;
                self.put(obj_mess);
            })
        }
        else{
            self.last = obj_mess.id;
            self.put(obj_mess);
        }
    }
    this.put=function(obj_mess){
        id=obj_mess.id; // ИД сообщения
        user_name=obj_mess.user_name; // Имя пользователя
        user_id=obj_mess.user_id; // ИД пользователя
        ts=obj_mess.ts; // ts - массив с временем и датой
        text=obj_mess.message; // сообщзение
        no_read=parseInt(obj_mess.no_read); // прочитано ли (1 - не прочитано, 0 прочитано)
        var b = document.createElement('div');
        b.id='mess_'+self.dialog+'_'+self.last;
        b.className='chat-message-item text_dialog_'+self.dialog;
        if(no_read){
            $(b).css({'background-color':'lightBlue'});
            b.onmouseover=function(){
                $(this).css({'background-color':''});
                $.get('/dialog/getinfo.php?type=3&id='+this.id.replace(/mess_([0-9]+)_([0-9]+)/,'$2'));
                chat_sum_id($('#sizeof_messages').html()-1);
                b.onmouseover='';
            }
        }
        b.innerHTML = '<a href="/profile/'+user_id+'/wall"><img class="message-avatar" src="'+obj_mess.img+'" alt="" width="40" height="40"></a>'+
                      '<span class="message-author">'+user_name+'</span>'+
                      '<span class="message-time">'+ts[1]+'</span>'+
                      '<span class="message-date">'+ts[0]+'</span>'+
                      '<p class="message-body">'+text+'</p>';
        $('.chat-message-list').append(b).scrollTop(0);
        $('.chat-message-list').scrollTop($('.chat-message-list')[0].scrollHeight);
    }
    this.parseData = function(message) {
        for(i in message){
            self.putMessage(message[i]);
        }
        if(!self.no_start)
            setTimeout(self.connection,1000);
    }
    this.connection = function() {
        self.comet = $.ajax({
                type: "GET",
                url:  "/dialog/get_message.php",
                data: {
                    'last_id':self.last,
                    'dialog_id':self.dialog
                },
                dataType: "json",
                timeout: self.timeout*1000,
                success: self.parseData,
                error: function(){
                    if(!self.no_start)
                    setTimeout(self.connection,1000);
               }
            });
    }
    this.init = function() {
        self.connection();
    }
    this.init();
}
