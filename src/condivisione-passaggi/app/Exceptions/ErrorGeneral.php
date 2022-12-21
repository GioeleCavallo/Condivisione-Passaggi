<?php 

namespace App\Exceptions;

class ErrorGeneral {

    public $title;
    public $description;
    public $level;

    function __contruct($title, $description, $level){
        self::$title = $title;
        self::$description = $description;
        self::$level = $level;
    }

}
?>