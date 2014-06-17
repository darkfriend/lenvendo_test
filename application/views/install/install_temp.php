<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Тест для levendo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="/include/js/sketch.js"></script>
        <script type="text/javascript" src="/include/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/include/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/include/css/bootstrap.min.css">
        <link rel="stylesheet" href="/include/css/styles.css">
        <!--[if IE]><script type="text/javascript" src="/include/js/excanvas.js"></script><![endif]-->
    </head>
    <body>
    <header class="container panel panel-default">
        <div class="row">
            <div class="pull-left">
                <h1>Тестовое задание для Levendo <small>(от Darkfriend)</small></h1>
            </div>
            <div class="panel panel-info pull-right">
                <header class="panel-heading">
                    <span>Привет, Гость!</span>
                </header>
                <section class="panel-body">
                    <a href="#" class="btn btn-primary">Авторизация</a>
                    <a href="#" class="btn btn-primary">Регистрация</a>
                </section>
            </div>
        </div>
        <div>
            <nav class="nav navbar">
                <a href="#" class="">Все рисунку</a>
                <a href="#" class="">Мои рисунки</a>
                <a href="#" class="">Мой профиль</a>
            </nav>
        </div>
    </header>
    <main class="container">
        <section class="row">
            <? include $content_view; ?>
        </section>
    </main>
    <footer>
        <script type="text/javascript" src="/include/js/main.js"></script>
    </footer>
    </body>
</html>