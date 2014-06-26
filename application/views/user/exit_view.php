<?if(!defined("START") || START!==true)die();?>
<? if($data['result']){ ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=$data['result_msg'];?>
    </div>
<? } else { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=$data['result_msg'];?>
    </div>
<? } ?>