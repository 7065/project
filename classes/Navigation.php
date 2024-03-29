<?php
namespace aitsydney;

use aitsydney\Database;

class Navigation extends Database{
    public $nav_array= array();

    public function__construct(){
        parent::__construct();
        $this -> initSession();
    }

    public function initSession(){
        if ( session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    public function getNavigation(){
        if( isset($_SESSION["auth"]) ){
            $max_level = 2;
            $min_level = 1;
        }
        else{
            $max_level =1;
            $min_level = 0;
        }
        $query = "
        SELECT 
        page_id,
        name,
        url,
        menu,
        content
        FROM page 
        WHERE LEVEL >= 1
        AND LEVEL <= 2 
        AND active = 1
        ORDER BY menu_order ASC
        ";
        $statement = $this-> connection -> prepare($query);
        $statement -> bind_param('ii', $min_level , $max_level);
        if ($statement -> execute() ){
            $result = $statement -> get_result();
            $nav_items=array();
            while($row = $result -> fetch_assoc() ){
                array_push( $nav_items, $row );
            }
            $this-> nav_array['navigation'] = $nav_items;
        }
    }
}
?>