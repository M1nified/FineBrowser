<?php
/**
 *
 */
 include_once("FineBrowserIterator.php");
class MD5Iterator extends FineBrowserIterator
{
  function __construct($file=".*",$path=".",$recursive=false)
  {
    parent::__construct($file,$path,$recursive);
  }
  function current(){
    $key = realpath($this->key());
    if(is_file($key)){
      $record = [
        "PATH" => realpath($key),
        "MD5" => md5_file($key)
      ];
      return $record;
    }else{
      $this->next();
      return $this->current();
    }
  }
}

 ?>
