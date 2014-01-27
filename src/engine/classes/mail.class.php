<?php

/*
 * Пример структуры таблицы для очереди почтовика
 * 
        CREATE TABLE IF NOT EXISTS `send_mail` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `address` varchar(255) CHARACTER SET utf8 NOT NULL,
         `subject` varchar(255) CHARACTER SET utf8 NOT NULL,
         `body` text CHARACTER SET utf8 NOT NULL,
         `is_html` tinyint(1) NOT NULL,
         PRIMARY KEY (`id`)
       ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;
 */


class send_mail extends db{
    static $mail=null;
    
    // Добавляет письмо в очередь
    static function add($address,$subject,$body,$html=false){
        $db = db::create();
        $dbRes = $db->insert('send_mail',array(
            'address'=>$address,
            'subject'=>$subject,
            'body'=>$body,
            'is_html'=>$html?'1':'0'));
        return $dbRes['id'];
    }

    static function send_mail_by_id($mailID){
        $result = array();
        $db = db::create();
        $mail = $db->getone('send_mail', $mailID);
        if ($mail==false) return false;
        if(!self::send($mail['address'],$mail['subject'],$mail['body'],$mail['is_html']?true:false)){
            $result['error']=true;
        }
        $db->delete('send_mail', $mailID);
        return true;
    }

    //Выборка из очереди и удаление отправленных
    static function send_mails($limit=10000){
        $result = array();
        $mails=db::create()->db->query('select id from send_mail order by id asc limit '.$limit);
        if(!$mails)return false;
        $mails=$mails->fetchAll();
        foreach($mails as $item){
               self::send_mail_by_id($item['id']);
               $result[] = $item['id'];
        }
        return $result;
    }
    // Отправляет письмо
    static function send($address,$subject,$body,$html=true){
        if(!self::$mail)self::$mail=send_mail::create_m();
        $mail=self::$mail;
        if($html)$mail->IsHTML(true);
        else $mail->IsHTML(false);
        $mail->AddAddress($address);
        $mail->Subject=$subject;
        $mail->Body=$body;
        $send=$mail->Send();
        $mail->ClearAddresses();
        $mail->ClearAttachments();
        return $send;
    }

    static private function create_m(){
        $from='Avatoria';
        $site='noreply@avatorya.ru';
        $mail=new PHPMailer();
        $mail->IsMail();
        $mail->FromName=$from;
        $mail->From=$site;
        return $mail;
    }
}
