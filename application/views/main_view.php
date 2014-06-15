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
        <canvas id="colors_sketch" height="300" data-imgid='2' data-img='/upload/16.06.2014/239595759_3c3626b24a_b.jpg' style="background: url('/upload/16.06.2014/239595759_3c3626b24a_b.jpg') no-repeat; background-size: cover;"></canvas>
    </section>
    <footer class="panel-footer nav">
        <div class="tools2 pull-right">
            <a href="#colors_sketch" data-download="png" class="btn bg-primary">Сохранить</a>
            <a id="canvas_clear" href="#colors_sketch" data-redraw="" class="btn btn-warning">Очистить</a>
        </div>
    </footer>
</div>
<!--<h1>main <?php echo $data; ?> </h1>-->