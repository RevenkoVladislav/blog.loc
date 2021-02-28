<?php

spl_autoload_register(function($class){
    $classPath = ['/controllers/', '/models/', '/components/'];

    foreach($classPath as $path){
        $filePath = ROOT . $path . $class . '.php';
        if(file_exists($filePath)){
            require $filePath;
        }
    }
});