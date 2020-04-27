<?php

use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

use app\manager\PersonManager;

$this->breadcrumbs[] = [
    'name' => 'Просмотр справочника',
];

?>

<script>
    $(function () {
        $('#content').load('/ajax/list?limit=5');
    });
</script>
