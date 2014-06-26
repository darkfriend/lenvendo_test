<?if(!defined("START") || START!==true)die();?>
<? if($data['isAuth']){ ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?=$data['result']?> </strong><?=$data['result_msg'];?>
    </div>
<? } elseif($data['error']) { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?=$data['result']?> </strong><?=$data['result_msg'];?>
    </div>
<? } ?>
<? if(!$data['isAuth']){ ?>
<form action="/user/auth/" method="POST" role="form">
    <div class="form-group">
        <input type="text" name="login" placeholder="Введите свой логин" value="" class="form-control" required />
    </div>
    <div class="form-group">
        <input type="password" name="pass" placeholder="Введите свой пароль" value="" class="form-control" required />
    </div>
    <button type="submit" class="btn btn-default">Авторизоваться</button>
</form>
<? } ?>