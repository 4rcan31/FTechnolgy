<?php


class ViewData{

    static $data;

    public static function setData(Array|object $data){
        $_SESSION['dataview'] = $data;
        return 0;
    }



    public static function get(){
        return $_SESSION['dataview'];
    }


    public static function unsetData(){
        unset($_SESSION['dataview']);
        return 0;
    }  
}