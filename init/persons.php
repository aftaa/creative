<?php

/** @var stdClass $app */

use app\manager\PersonManager;

$app->config['title'] = 'Внесение абонентов';

$personRows = (new PersonManager($app))->initPersonTableFromFile();

?>

<pre>
    <?php print_r($personRows) ?>
</pre>
