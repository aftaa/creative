<?php

use app\helper\PhoneNumberFormatterHelper;
use app\manager\PersonManager;
use app\manager\PhoneManager;
use app\repository\PersonRepository;
use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$limit = $_REQUEST['limit'] ?? 5;
$offset = $_REQUEST['offset'] ?? 0;


$manager = new PhoneManager($app);
$phone = $_REQUEST['phone'];
$persons = $manager->searchPhone($phone, $limit, $offset);


$phoneNumberHelper = new PhoneNumberFormatterHelper(
    $this->app->config['phone_number_format']
);

$pages = ceil(count($persons) / $limit);

?>

<table class="table table-hover">
    <thead>
    <th>№</th>
    <th>Телефон</th>
    <th>Фамилия</th>
    <th>Имя</th>
    <th>Отчество</th>
    </thead>
    <tbody>
    <?php foreach ($persons as $person): ?>
        <tr>
            <td><?= $person->getId() ?></td>
            <td>
                <?php foreach ($person->getPhones() as $phone): ?>
                    <?= ($phone)->getPhone() ?>
                    <br>
                <?php endforeach ?>
            </td>
            <td><?= $person->getFirstName() ?></td>
            <td><?= $person->getLastName() ?></td>
            <td><?= $person->getMiddleName() ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="99">
            <div style="font-size: 13px" id="pagination">
                <?php for ($i = 0; $i < $pages; $i++): ?>
                    <a href="#"
                       data-phone="<?= $phone ?>"
                       data-offset="<?= $i * $limit ?>"
                       data-limit="<?= $limit ?>">
                        <?= $i + 1 ?>
                    </a>
                <?php endfor ?>
            </div>
        </th>
    </tr>

    </tfoot>
</table>

<script>
    "use strict";

    $(function () {
        $('#pagination a').on('click', function () {
            $(document).css({cursor: 'wait'});
            let limit = this.dataset.limit;
            let offset = this.dataset.offset;
            let phone = this.dataset.phone;
            $('#content').load('/ajax/search', {
                'limit': limit,
                'offset': offset,
                'phone': phone
            }, function () {
                $(document).css({cursor: 'normal'});
            });
            return false;
        })
    });
</script>