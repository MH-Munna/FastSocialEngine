<?php
/**
 * Created by PhpStorm.
 * User: Spectrum
 * Date: 27.11.13
 * Time: 18:03
 */

$user = users::get(true);
if (!$user->get_field('i_admin')){header('location: '.base_site_url);}
