# lenvendo_test  README #
=============

###Что было написано:###

- логика фреймворка c соблюдением mvc-паттерна
    - внутри находится инсталлер
- пользователи
    - Авторизация пользователя
    - Регистрация пользователя
    - сообщения о результате
- рисунки
    - создание рисунка
    - редактирование рисунка
    - удаление рисунка
    - просмотр рисунков текущего пользователя
    - просмотр рисунков всех пользователей
    - сообщения о результате
- шаблон
- страница 404

###Логика фреймворка:###

- Логика фреймворка максимально соответствует mvc-паттерну.
- Настройки фреймворка находятся тут: /application/config.php (Далее config. Там есть комментарии, описывать тут не буду)
- Ядро конроллера находится в /application/core/controller.php
- Ядро моделей в /application/core/model.php
- Ядро въюшек в /application/core/view.php
- Маршрутизатор в /application/core/route.php

**Для работы с БД используется класс SafeMySQL. Находится в /application/core/safemysql_class.php**

#Инсталлер:#
- Контроллер находится тут: /application/controllers/controller_install.php
- Модель /application/models/install_model.php
- Вывод тут: /application/views/install/install_view.php
- Инсталлер запускается по ссылке: *site.ru*/install/

*Внимание! Перед началом установки нужно указать доступы в config*

Дефолтные данные:
- логин админа: admin
- пароль админа: admin
- группы пользователей: admin(id=1), user(id=2)
- группа для регистрируемых пользователей: user (правится в config)
