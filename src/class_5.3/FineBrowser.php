<?php
include_once('FineBrowserIterator.php');
include_once('MD5Iterator.php');
class FineBrowser{
  static function ls($file=".*",$path=".",$recursive=false){
    $files = array();
    $iterator = new FineBrowserIterator($file,$path,$recursive);
    foreach ($iterator as $key => $value) {
      array_push($files,realpath($key));
    }
    return $files;
  }
  static function md5_file($file=".*",$path=".",$recursive=false){
    // $iterator = new FineBrowserIterator($file,$path,$recursive);
    $scores = array();
    foreach (new MD5Iterator($file,$path,$recursive) as $key => $value) {
      array_push($scores,$value);
    }
    return $scores;
  }
}
?>
