<? $data['check_db']['status'] ?>
<? if($data['check_db']['status']){ ?>
    <? for($i=0, $cnt = count($data['check_db']['msg']); $i<$cnt; $i++ ){ ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=$data['check_db']['msg'][$i];?>
        </div>
    <? } ?>
<? } else { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Ошибка установки! </strong><?=$data['check_db']['msg'];?>
    </div>
<? } ?>
<h1>INSTALL</h1>
<?php
    if(isset($_POST['errorExceptionValue'])){
        echo htmlspecialchars($_POST['errorExceptionValue'], ENT_QUOTES | ENT_HTML5 | ENT_DISALLOWED | ENT_SUBSTITUTE, 'UTF-8');
    }
?>
<!--<pre>
<?
    print_r($data);
?>
</pre>-->
