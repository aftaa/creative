<?php

$this->breadcrumbs[] = [
    'name' => 'Внесение информации',
];

?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form class="form" action="">

                <p class="lead">Все поля обязательны для заполнения</p>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="person[first_name]"
                               placeholder="Фамилия" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="person[last_name]"
                               placeholder="Имя" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="person[middle_name]"
                               placeholder="Отчество" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="phone[phone]" id="phone"
                               placeholder="Телефон" required>
                    </div>
                </div>

                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default" value="Внести">
                </div>
            </form>

        </div>
    </div>

    <script>
        $(function () {
            $('#content').load('404.php');
        })
    </script>