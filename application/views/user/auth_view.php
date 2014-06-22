<?
//var_dump($_POST);
var_dump($data);

//if(!$data){
if($data['error']){
?>
    <? if($data['isAuth']){ ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?=$data['result']?> </strong><?=$data['result_msg'];?>
        </div>
    <? } else { ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong><?=$data['result']?> </strong><?=$data['result_msg'];?>
        </div>
    <? } ?>
<? } ?>
<?  ?>
<form action="/user/auth/" method="POST" role="form">
    <div class="form-group has-success has-feedback">
        <input type="text" name="login" placeholder="Введите свой логин" value="" class="form-control" />
        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
    </div>
    <div class="form-group">
        <input type="text" name="pass" placeholder="Введите свой пароль" value="" class="form-control" />
    </div>
    <button type="submit" class="btn btn-default">Авторизоваться</button>
</form>
<? //} ?>