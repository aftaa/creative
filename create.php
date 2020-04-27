<?php


use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */


$this->breadcrumbs[] = [
    'name' => 'Внесение информации',
];

?>


<script>
    $('#content').html('/ajax/');

    $('form.form').submit(function () {

        return false;
    })
</script>