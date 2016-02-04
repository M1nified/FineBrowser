<?php
/**
 *
 */
include_once("MD5Iterator.php");
class FilesSupervisor
{
  function __construct($path,$recursive=true)
  {
    $this->path = $path;
    $this->is_recursive = $recursive;
  }
  function sum_to_file(){

  }
}

?>
