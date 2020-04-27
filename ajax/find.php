<?php

use app\entity\Person;
use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$name = $_REQUEST['name'] ?? '';

/** @var PDO $db */
$db = $app->db;

$stmt = $db->dbh->prepare("SELECT * FROM `person` WHERE MATCH (first_name,last_name,middle_name) AGAINST '$name'");

$rows = $stmt->fetchAll();
echo '<pre>'; print_r($rows); echo '</pre>';
$persons = [];
foreach ($rows as $row) {
    $person = (new Person)
        ->setId($row['id'])
        ->setFirstName($row['first_name'])
        ->setMiddleName($row['middle_name'])
        ->setLastName($row['last_name'])
        ->setCreatedAt(new DateTime($row['created_at']));
    $persons[$person->getId()] = $person;
}
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
                    <?= $phoneNumberHelper->format($phone) ?>
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
<!--            <div style="font-size: 13px" id="pagination">-->
<!--                --><?php //for ($i = 0; $i < $pages; $i++): ?>
<!--                    <a href="#"-->
<!--                       data-offset="--><?//= $i * $limit ?><!--"-->
<!--                       data-limit="--><?//= $limit ?><!--">-->
<!--                        --><?//= $i + 1 ?>
<!--                    </a>-->
<!--                --><?php //endfor ?>
<!--            </div>-->
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
            $('#result').load('/ajax/find', {
                'limit': limit,
                'offset': offset,
            }, function () {
                $(document).css({cursor: 'normal'});
            });
            return false;
        })
    });
</script>