<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
include_once('../src/load.php');//Load class_uses
echo 'FilesSupervisor example';
$filesSupervisor = new FilesSupervisor(".");
$filesSupervisor->sum_to_file('.','md5s.csv');
?>
