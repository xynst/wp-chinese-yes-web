<?php
session_start();

$file_path = "/root/chinese-yes/log/".session_id();

if(file_exists($file_path)){
    $str = file_get_contents($file_path);
    $str = str_replace("\n","<br />",$str);
    echo $str;
}
