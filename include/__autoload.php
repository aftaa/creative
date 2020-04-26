<?php

spl_autoload_register(function(string $className) {
    $className = str_replace('\\', '/', $className);
    $classFilename = "$_SERVER[DOCUMENT_ROOT]/$className.php";
    if (file_exists($classFilename)) {
        require_once $classFilename;
    } else {
        header('HTTP/1.0 404 Not Found');
        echo "<h1>404 Not Found</h1>";
        echo "<h3>Is file <big>$classFilename</big> exists?</h3>";
    }
});
