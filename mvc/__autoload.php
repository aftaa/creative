<?php

spl_autoload_register(function(string $className) {
    $className = str_replace('\\', '/', $className);
    $classFilename = "$_SERVER[DOCUMENT_ROOT]/$className.php";
    require_once $classFilename;
});
