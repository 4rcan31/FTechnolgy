<?php


class ViewData{

    static $data;

    public static function setData(Array $data){
        $_SESSION['dataview'] = $data;
    }



    public static function get(){
        return arrayToObject($_SESSION['dataview']);
    }

    

    
}