<?php
namespace aitsydney
class Database{
protected $connection;
protected function__construct(){
    $this -> connection = mysqli_connect('localhost','website', 'password','data7065');
}
}
?>