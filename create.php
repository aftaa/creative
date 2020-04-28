<?php


use app\entity\Phone;
use app\manager\PersonManager;
use app\repository\PersonRepository;
use app\repository\PhoneRepository;
use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */


$this->breadcrumbs[] = [
    'name' => 'Внесение информации',
];

if (!empty($_POST['submit'])) {

    $phoneRepository = new PhoneRepository($app);
    try {
        $phone = new Phone($_POST['phone']['phone'], 0);
    } catch (Exception $e) {
        $error = 'Неверный формат номера';
    }

    if ($phoneRepository->numberExists($phone)) {
        $error = 'Номер уже используется';
    }

    $person = (new PersonManager($app))->createPersonFromForm($_REQUEST['person']);
    $personId = (new PersonRepository($app->db, $app))->pushPerson($person);
    $person->setId($personId);

    $phoneRepository->savePhone($phone, $personId);
    header('Location: /list');
}






?>

<hr>
<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form class="form" action="/create" method="post" id="form">

                <p class="lead">Все поля обязательны для заполнения</p>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               value="<?= $_REQUEST['person']['first_name'] ?? '' ?>"
                               name="person[first_name]"
                               placeholder="Фамилия" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               value="<?= $_REQUEST['person']['last_name'] ?? '' ?>"
                               name="person[last_name]"
                               placeholder="Имя" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               value="<?= $_REQUEST['person']['middle_name'] ?? '' ?>"
                               name="person[middle_name]"
                               placeholder="Отчество" required>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="phone[phone]" id="phone"
                               maxlength="10" minlength="10"
                               value="<?= $_REQUEST['phone']['phone'] ?? '' ?>"
                               placeholder="Телефон (10 цифр)" required>
                        <small><?php if (!empty($error)) {
                            echo $error;
                            } ?>
                        </small>
                    </div>
                </div>

                <div class="text-center col-xs-12">
                    <input type="submit" class="btn btn-default" value="Внести запись" id="btnSubmit" name="submit">
                </div>
            </form>

        </div>
    </div>
</div>
