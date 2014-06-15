$(function() {
    initCanvas();
});
function initCanvas(){
    //config
    var arrSizedMarker = [3, 5, 10, 15],
        arrColorsMarker = ['#000','#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#000', '#fff'];
//    $.each(['#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#000', '#fff'], function() {
//        $('#colors_canvas .tools').append("<a href='#colors_sketch' data-color='" + this + "' style='width: 10px; background: " + this + ";'></a> ");
//    });
//    $.each([3, 5, 10, 15], function() {
//        $('#colors_canvas .tools').append("<a href='#colors_sketch' data-size='" + this + "' style='background: #ccc'>" + this + "</a> ");
//    });
    $("#mark_color > a").each(function(index, elem){
        $(elem).attr({
            'data-color' : arrColorsMarker[index]
        }).text(arrColorsMarker[index]).css('background-color',arrColorsMarker[index]);
    });
    $("#mark_size > a").each(function(index, elem){
        $(elem).attr({
            'data-size' : arrSizedMarker[index]
        }).text(arrSizedMarker[index]);
    });
    
    $('canvas').css({
        width : $('main').innerWidth(),
        marginLeft: '-16px' //.conteiner добавляет 15px по краям + 1px border
    });
    
    $('#colors_sketch').sketch();
    
    $('#canvas_clear').bind('click',function(){
        //$('#colors_sketch').sketch({actions:'redraw'});
        //$('#colors_sketch').sketch().redraw();
        //sketch({action:'redraw'});
        //Sketch.redraw();
        //$('#canvas_clear').sketch.redraw();
        //$('#colors_sketch').sketch('color','#f00');
        console.log('canvas_clear');
        return false;
    });
}

