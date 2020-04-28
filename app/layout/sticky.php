<?php

use creative\ViewLayout;

/** @var stdClass $app */
/** @var ViewLayout $this */


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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="/js/jquery-3.5.0.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    <!-- creative -->
    <link href="/css/creative.css" rel="stylesheet">
    <script src="/js/phone.manipulation.js"></script>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#" onclick="return false;"><?=
            $this->app->config['title'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarCollapse" aria-controls="navbarCollapse"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/about">Техническое<br>задание</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/create">Внесение<br>информации
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link"
                       href="/list">Просмотр<br>справочника</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/search">Поиск<br>по
                        номеру телефона</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/find">Поиск<br>по
                        абоненту</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main role="main" class="container">
<!--    <h1 class="mt-5">--><?//= $this->app->config['title'] ?><!--</h1>-->
    <h1 class="mt-5"></h1>
    <?php require_once '_breadcrumbs.php' ?>
    <div id="content"><?= $this->content ?? '' ?></div>
</main>

<footer class="footer">
    <div class="container">
        <div style="float: right;">
            Сделано на базе «<a href="https://kuba.moscow/"
                                target="_blank">Свой Велосипед Фреймворк</a>»
        </div>
        <span class="text-muted">
            &copy; <?= date('Y') ?> <a href="mailto:mail@maxim-gabidullin.ru">Maxim
                Gabidullin</a>
        </span>
    </div>
</footer>
<?php require_once 'include/yandex.metrka.html' ?>
</body>
</html>
