<?if(!defined("START") || START!==true)die();?>
<div class="row">
    <? for( $i=0, $cnt = count($data['resultAll']); $i<$cnt; $i++ ){ ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="<?=PATH_TO_SAVE_IMG.$data['resultAll'][$i]['create_date'].'/'.$data['resultAll'][$i]['name_file']?>" width="377" class="img-rounded">
                <div class="caption btn-group btn-group-justified">
                    <a href="/picture/edit/id/<?=$data['resultAll'][$i]['ID']?>/" class="btn bg-primary">Редактировать</a>
                    <a href="/picture/delete/id/<?=$data['resultAll'][$i]['ID']?>/" class="btn btn-danger">Удалить</a>
                </div>
            </div>
        </div>
    <? } ?>
</div>
