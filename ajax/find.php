<?php

use app\entity\Person;
use app\repository\PersonRepository;
use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */

$s = $_REQUEST['s'] ?? '';
$repository = new PersonRepository($app->db, $app);
$persons = $repository->findWords($s ?? '');

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
    <?php if (!empty($persons)): ?>
        <tbody>
        <?php foreach ($persons as $person): ?>
            <tr>
                <td><?= $person->getId() ?></td>
                <td><?= $person->getFirstName() ?></td>
                <td><?= $person->getLastName() ?></td>
                <td><?= $person->getMiddleName() ?></td>
                <td>
                    <?php foreach ($person->getPhones() as $phone): ?>
                        <?= $phone->getPhone() ?>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?= $person->getCreatedAt()->format('d.m.Y H:i') ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    <?php endif ?>
    <tfoot>
    <tr>
        <th colspan="99">
        </th>
    </tr>

    </tfoot>
</table>
