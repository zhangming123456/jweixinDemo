<?php
/**
 * Created by PhpStorm.
 * User: Aaronzm
 * Date: 2017/8/14 0014
 * Time: 0:57
 */

$url = "http://www.jb51.net";
if (isset($url)) {
    Header("Location: $url");
}