<?php

require_once 'include/__autoload.php';

try {
    (new \creative\Kernel(
        require_once 'app/config/config.php'
    ))->run();

} catch (Exception $e) {
?>

    <h1>Ooops, Houston, we have an uncaught Exception!</h1>
    <h2><?= $e->getMessage() ?></h2>
    <h2>File: <?= $e->getFile() ?></h2>
    <h4>Line: <?= $e->getLine() ?></h4>
    <h5><pre><?= print_r($e->getTrace()) ?></pre></h5>

<?php
}
