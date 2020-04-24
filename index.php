<?php

use mvc\creative\Kernel;

require_once 'mvc/__autoload.php';

(new Kernel(
    require_once 'app/config/config.php'
))->run();