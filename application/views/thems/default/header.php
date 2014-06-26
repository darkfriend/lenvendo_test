<?if(!defined("START") || START!==true)die();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Тест для levendo</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="/include/js/sketch.js"></script>
        <script type="text/javascript" src="/include/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/include/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/include/css/bootstrap.min.css">
        <link rel="stylesheet" href="/include/css/styles.css">
        <!--[if IE]><script type="text/javascript" src="/include/js/excanvas.js"></script><![endif]-->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <header class="container panel panel-default">
        <div class="row">
            <div class="pull-left">
                <h1>Тестовое задание для Levendo <small>(от Darkfriend)</small></h1>
            </div>
            <div class="panel panel-info pull-right">
                <header class="panel-heading">
                    <span>Привет, <?=($data['user_id']) ? $data['login'] : 'Гость' ?>!</span>
                </header>
                <section class="panel-body">
                    <div class="btn-group">
                    <? if($data['user_id']) { ?>
                        <a href="/user/" class="btn btn-primary">Мой профиль</a>
                        <a href="/user/exit/" class="btn btn-danger">Выйти</a>
                    <? } else { ?>
                        <a href="/user/auth/" class="btn btn-primary">Авторизация</a>
                        <a href="/user/reg/" class="btn btn-primary">Регистрация</a>
                    <? } ?>
                    </div>
                </section>
            </div>
        </div>
        <div>
            <nav id="main_menu" class="nav navbar navbar-default" role="navigation">
                    
                    <li class="pull-left">
                        <a href="/" class="">Главная</a>
                    </li>
                    <li class="pull-left">
                        <a href="/picture/" class="">Все рисунки</a>
                    </li>
                    <li class="pull-left">
                        <a href="/picture/add/" class="">Создать рисунок</a>
                    </li>
                    <li class="pull-left">
                        <a href="/picture/user/" class="">Мои рисунки</a>
                    </li>
                
                
            </nav>
        </div>
    </header>
    <main class="container">
        <section class="row">
