<?php

use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$this->breadcrumbs[] = [
    'name' => 'Поиск по абоненту',
];


?>

<hr>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form class="form" action="">

                <p class="lead">ФИО или часть</p>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               id="s"
                               placeholder="" required>
                        <!--                        <input type="submit" class="btn btn-default"-->
                        <!--                               value="Поиск">-->
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div id="result">

</div>


<script>
    $('#result').load('/ajax/find');
    $('#name').on('keyup', function () {
        if (this.value.length > 3) {
            let name = this.value;

            $('#result').load('/ajax/find', {
                name: name,
                limit: 25,
            });
        } else {
            $('#result').load('/ajax/find');
        }
    });
</script>