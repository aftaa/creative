<?php if ($this->breadcrumbs): ?>
    &gt; <a href="/"><?= $app->config['title'] ?></a>
    <?php foreach ($this->breadcrumbs as $breadcrumb): ?>
        <?php if (!empty($breadcrumb['href'])): ?>
            &gt;
            <a href="<?= $breadcrumb['href'] ?>"><?= $breadcrumb['name'] ?></a>
        <?php else: ?>
            &gt; <?= $breadcrumb['name'] ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>
