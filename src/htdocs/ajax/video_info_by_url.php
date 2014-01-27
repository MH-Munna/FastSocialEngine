<?php
/**
 * Данный файл возвращает информацию о видеоролике на ютубе по URL в формате json
 * User: Admin
 * Date: 29.12.13
 * Time: 1:18
 */

/**
 * В принципе это здесь не нужно, просто с подключением движка
 * к этому файлу смогут обращаться только залогиненные пользователи
 */

include '../../engine/engine.inc.php';
$session_info = users::session_info();

$result = array();

$url = $_REQUEST['videoURL'];
$host = parse_url($url, PHP_URL_HOST);
$path = parse_url($url, PHP_URL_PATH);
$query = parse_url($url, PHP_URL_QUERY);

parse_str($query, $args);

//Проверка строки на корректность

if (($host != 'youtube.com')&&($host != 'www.youtube.com' )) {
    $result['error'] = 1;
    $result['error_text'] = 'Неправильная ссылка на видеоролик (youtube)';
}
if ((empty($result['error']))&&(empty($args['v']))){
    $result['error'] = 2;
    $result['error_text'] = 'Не корректный формат ссылки';
}

//В случае отсутствия ошибок, запрашиваем данные у тюбика
if (empty($result['error'])){

    //The Youtube's API url
    define('YT_API_URL', 'http://gdata.youtube.com/feeds/api/videos?q=');

    //Change below the video id.
    $video_id = $args['v'];

    //Using cURL php extension to make the request to youtube API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, YT_API_URL . $video_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //$feed holds a rss feed xml returned by youtube API
    $feed = curl_exec($ch);
    curl_close($ch);

    //Using SimpleXML to parse youtube's feed
    $xml = simplexml_load_string($feed);

    $entry = $xml->entry[0];
    //If no entry whas found, then youtube didn't find any video with specified id
    if(!$entry) exit('Error: no video with id "' . $video_id . '" whas found. Please specify the id of a existing video.');
    $media = $entry->children('media', true);
    $group = $media->group;

    $title = $group->title;//$title: The video title
    $desc = $group->description;//$desc: The video description
    $vid_keywords = $group->keywords;//$vid_keywords: The video keywords
    $thumb = $group->thumbnail[0];//There are 4 thumbnails, the first one (index 0) is the largest.
    //$thumb_url: the url of the thumbnail. $thumb_width: thumbnail width in pixels.
    //$thumb_height: thumbnail height in pixels. $thumb_time: thumbnail time in the video
    list($thumb_url, $thumb_width, $thumb_height, $thumb_time) = $thumb->attributes();
    $content_attributes = $group->content->attributes();
    //$vid_duration: the duration of the video in seconds. Ex.: 192.
    $vid_duration = $content_attributes['duration'];
    //$duration_formatted: the duration of the video formatted in "mm:ss". Ex.:01:54
    $duration_formatted = str_pad(floor($vid_duration/60), 2, '0', STR_PAD_LEFT) . ':' . str_pad($vid_duration%60, 2, '0', STR_PAD_LEFT);

    //echoing the variables for testing purposes:
    $result['info']['title'] = $title.'';
    $result['info']['desc'] = $desc.'';
    $result['info']['video_keywords']= $vid_keywords.'';
    $result['info']['thumbnail_url']= $thumb_url.'';
    $result['info']['thumbnail_width']= $thumb_width.'';
    $result['info']['thumbnail_height']= $thumb_height.'';
    $result['info']['thumbnail_time']= $thumb_time.'';
    $result['info']['video_duration']= $vid_duration.'';
    $result['info']['video_duration_formatted'] = $duration_formatted.'';
}

echo json_encode($result);