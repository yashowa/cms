<?php
Class Router
{
  public $_status;

  public static function setStatus(bool $value){
    $this->$_status=$value;
  }
  public static function routes($list){
    return $list;
  }
  function ___construct(){

  }



}
?>
