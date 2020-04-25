<?php

use creative\Kernel;

require_once '__autoload.php';

(new Kernel(
    require_once 'app/config/config.php'
))->run();
