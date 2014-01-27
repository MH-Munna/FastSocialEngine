<?php

class other{
    static function loc($url='/'){
        header('Location: '.base_site_url.$url);
    }
}