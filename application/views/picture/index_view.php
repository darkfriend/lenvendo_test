<div class="row">
    <? for($i=0, $cnt = count($data); $cnt<$i; $i++){ ?>
        <div class="col-6 col-sm-6 col-lg-4">
            <img src="<?=PATH_ROOT.PATH_TO_SAVE_IMG.$data[$i]['create_date'].'/'.$data[$i]['name_file']?>" class="img-rounded">
            <div class="btn-group">
                <a href="/picture/edit/id/<?=$data[$i]['ID']?>/" class="btn bg-primary">Редактировать</a>
                <a href="/picture/delete/id/<?=$data[$i]['ID']?>/" class="btn btn-danger">Удалить</a>
            </div>
        </div>
    <? } ?>
    <?//=$cnt;  ?>
</div>
