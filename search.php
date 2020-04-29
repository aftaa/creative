<?php


use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$this->breadcrumbs[] = [
    'name' => 'Поиск по номеру телефона',
];


?>

<hr>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form class="form" action="">

                <p class="lead">Введите телефонный номер<br>
                <small>или его часть:</small></p>

                <div class="col-xs-12">
                    <div class="form-group">
                        <div style="float:left;font-size:21px;">+7&nbsp;</div>
                        <input type="text" class="orm-control"
                               minlength="3" id="phone"
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
    $('#phone').on('keyup', function () {
        if (this.value.length > 1) {
            let phone = this.value;
            console.log(phone)

            $('#result').load('/ajax/search', {
                phone: phone,
                limit: 25,
            });
        } else {
            $('#result').html('');
        }
    });
</script>
