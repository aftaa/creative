<?php

/** @var stdClass $app */

?><!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.png">

    <title><?= $this->app->config['title'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="/css/creative.css" rel="stylesheet">
</head>

<body>

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/"><?= $this->app->config['title'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/create">Внесение информации
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/list">Просмотр справочника</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/search">Поиск по
                        номеру телефона</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/find">Поиск по
                        абоненту</a>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text"
                       placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-success my-2 my-sm-0"
                        type="submit">Поиск
                </button>
            </form>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    <h1 class="mt-5"><?= $this->app->config['title'] ?></h1>

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

    <p class="lead">
        <?= $this->content ?? '' ?>
    </p>

    <!--    <p class="lead">Pin a fixed-height footer to the bottom of the viewport in-->
    <!--        desktop browsers with this custom HTML and CSS. A fixed navbar has been-->
    <!--        added with <code>padding-top: 60px;</code> on the <code>body &gt;-->
    <!--            .container</code>.</p>-->
    <!--    <p>Back to <a href="../sticky-footer/">the default sticky footer</a> minus-->
    <!--        the navbar.</p>-->
</main>


<footer class="footer">
    <div class="container">
        <span class="text-muted">
            &copy; <?= date('Y') ?> <a href="mailto:mail@maxim-gabidullin
            .ru">Maxim
                Gabidullin</a>
        </span>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
