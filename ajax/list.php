<?php

use app\helper\PhoneNumberFormatterHelper;
use app\manager\PersonManager;
use app\repository\PersonRepository;
use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$manager = new PersonManager($app);

$limit = $_REQUEST['limit'] ?? 5;
$offset = $_REQUEST['offset'] ?? 0;
$total = (new PersonRepository($app->db, $app))->howMuch();
$pages = ceil($total / $limit);

$persons = $manager->getPage($limit, $offset);

$phoneNumberHelper = new PhoneNumberFormatterHelper(
    $this->app->config['phone_number_format']
);

?>


<table class="table table-hover">
    <thead>
    <th>№</th>
    <th>Фамилия</th>
    <th>Имя</th>
    <th>Отчество</th>
    <th>Телефон(ы)</th>
    <th>Дата создания</th>
    </thead>
    <tbody>
    <?php foreach ($persons as $person): ?>
        <tr>
            <td><?= $person->getId() ?></td>
            <td><?= $person->getFirstName() ?></td>
            <td><?= $person->getLastName() ?></td>
            <td><?= $person->getMiddleName() ?></td>
            <td>
                <?php foreach ($person->getPhones() as $phone): ?>
                    <?//= $phoneNumberHelper->format($phone) ?>
                <?php echo $phone->getPhone() ?>
                    <br>
                <?php endforeach ?>
            </td>
            <td>
                <?= $person->getCreatedAt()->format('d.m.Y H:i') ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="99">
            <div style="font-size: 13px" id="pagination">
                <?php for ($i = 0; $i < $pages; $i++): ?>
                    <a href="#"
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
            $('#content').load('/ajax/list', {
                'limit': limit,
                'offset': offset,
            }, function () {
                $(document).css({cursor: 'normal'});
            });
            return false;
        })
    });
</script>