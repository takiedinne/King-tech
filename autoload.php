<?php
    function loadLib($class){
        $path = __DIR__."/vendor/";
        require_once $path.$class.".php";
    }
    spl_autoload_register("loadLib");
?>