<? var_dump($data); ?>

<? if( !$data['result'] && $data['user_id'] && !$data['error'] ){ ?>
<? if($data['edit']){ ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=$data['result_msg'];?>
    </div>
<? } ?>
<div id="colors_canvas" class="panel panel-primary">
    <header class="panel-heading">
        <div class="btn-toolbar">
            <div id="" class="tools btn-group" >
                <a href="#colors_sketch" class="btn btn-primary" data-tool="marker">Маркер</a>
                <a href="#colors_sketch" class="btn btn-primary" data-tool="eraser">Стёрка</a>
            </div>
            <div id="mark_color" class="btn-group">
                <a href="#colors_sketch" class="btn btn-default"></a>
                <a href="#colors_sketch" class="btn btn-default"></a>
                <a href="#colors_sketch" class="btn btn-default"></a>
                <a href="#colors_sketch" class="btn btn-default"></a>
            </div>
            <div id="mark_size" class="btn-group">
                <a href="#colors_sketch" data-size="" class="btn btn-default" style="background: #ccc"></a>
                <a href="#colors_sketch" data-size="" class="btn btn-default" style="background: #ccc"></a>
                <a href="#colors_sketch" data-size="" class="btn btn-default" style="background: #ccc"></a>
                <a href="#colors_sketch" data-size="" class="btn btn-default" style="background: #ccc"></a>
            </div>
            <div class="btn-group">
                <div id="set_canvas_width" class="btn-group dropdown-toggle">
                    <a href="#" class="btn pull-left color-white" data-toggle="dropdown">Ширина:</a>
                    <div type="button" class="btn btn-primary pull-left" data-toggle="dropdown">
                        <span>
                            <abbr>100%</abbr>
                            <small class="caret ml5"></small>
                        </span>
                    </div>
                    <ul class="dropdown-menu" role="menu">
                        <li class="active"><a href="#" data-value="100%">100%</a></li>
                        <li><a href="#" data-value="500px">500px</a></li>
                        <li><a href="#" data-value="200px">200px</a></li>
                    </ul>
                </div>
                <div id="set_canvas_width" class="btn-group dropdown-toggle">
                    <a href="#" class="btn pull-left color-white" data-toggle="dropdown">Высота:</a>
                    <div type="button" class="btn btn-primary pull-left" data-toggle="dropdown">
                        <span>
                            <abbr>300px</abbr>
                            <small class="caret ml5"></small>
                        </span>
                    </div>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" data-value="200px">200px</a></li>
                        <li class="active"><a href="#" data-value="300px">300px</a></li>
                        <li><a href="#" data-value="500px">500px</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section class="panel-body">
<canvas id="colors_sketch" data-imgid='<?=$data['arrResult']['id']?>' height="<?= $data['arrResult']['size']['height'] ? $data['arrResult']['size']['height'] : '300' ?>" width="<?=$data['arrResult']['size']['width']?>" data-img='<?=PATH_TO_SAVE_IMG.$data['arrResult']['create_date'].'/'.$data['arrResult']['name_file']?>' style="background: url('<?=PATH_TO_SAVE_IMG.$data['arrResult']['create_date'].'/'.$data['arrResult']['name_file']?>') no-repeat; background-size: 100% 100%;"></canvas>
    </section>
    <footer class="panel-footer nav">
        <div class="tools2 pull-left">
            <a href="/picture/" data-redraw="" class="btn btn-toolbar">&DoubleLeftArrow; Назад</a>
        </div>
        <div class="tools2 pull-right">
            <a href="#colors_sketch" data-download="png" class="btn bg-primary">Сохранить</a>
            <a id="canvas_clear" href="#colors_sketch" data-redraw="" class="btn btn-warning">Удалить</a>
        </div>
    </footer>
</div>
<? } else { ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Внимание! </strong><?= $data['result_msg_html'] ? $data['result_msg_html'] : $data['result_msg'];?>
    </div>
<? } ?>
