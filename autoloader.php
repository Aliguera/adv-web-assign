<?php
    function loadClass( $classname ){
        //define class directory
        $classdir = 'classes';
        // define root application directory
        $root = $_SERVER["DOCUMENT_ROOT"];
        $classfile = strtolower( $classname ) . '.class.php';
        //include the class file from class directory
        include($root . '/' . $classdir . '/' . $classfile);
    }
    
    //register loadClass as a class loader
    spl_autoload_register('loadClass');
?>