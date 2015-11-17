<?php
class DB {
    public $mysqli;

    const salt = "";
    const host = "";
    const id = "";
    const pw = "";
    const db = "";

    function __construct()
    {
      $this->mysqli = new mysqli(static::host, static::id, static::pw, static::db);
      $this->mysqli->set_charset("utf8");
    }

    public function getSalt(){
        return self::salt;
    }
    public function gethost(){
        return self::host;
    }
    public function getid(){
        return self::id;
    }
    public function getpw(){
        return self::pw;
    }
    public function getdb(){
        return self::db;
    }
}
?>