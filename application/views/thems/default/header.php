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
    <?php
    if (!empty($_POST['data'])){
        $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_URL);
        $name = md5($data);
        $file = "/$name.png";
        if (!file_exists($file)){
            $image = str_replace(" ", "+", $data);
            $image = substr($image, strpos($image, ","));
            file_put_contents(PATH_TO_SAVE_IMG.$file, base64_decode($image));
            $parentImgID = filter_input(INPUT_POST, 'imgid', FILTER_SANITIZE_NUMBER_INT);
        }
        echo $file."<br>";
        echo $parentImgID;
        die();
    }
    ?>
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
