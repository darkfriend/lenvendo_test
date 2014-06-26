$(function() {
    if($('#colors_sketch').length){
        initCanvas();
        $('#canvas_clear').click(function(){
            clearCanvas();
            return false;
        });
        $('#canvas_delete').click(function(){
            var imgid = parseInt($('#colors_sketch').data('imgid')),
                urlForAjax = '/ajax/picture_delete/';
            var dataAjax = 'imgid='+parseInt(imgid);
            removeImageCanvas(urlForAjax,dataAjax,imgid);
            return false;
        });
    }
});
function initCanvas(){
    //config
    var arrSizedMarker = [3, 5, 10, 15],
        arrColorsMarker = ['#000','#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#000', '#fff'];
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
        width : $('main').innerWidth()-2,
        //marginLeft: '-16px' //.conteiner добавляет 15px по краям + 1px border
    });
    
    $('#colors_sketch').sketch();
}

function clearCanvas(){
    $('#colors_sketch').remove();
    $('#colors_canvas .panel-body').append('<canvas id="colors_sketch" height="300" width="1098"></canvas>');
    $('#colors_sketch').sketch();
}
function initAjax(urlForAjax,dataAjax,imgid){
    $.ajax({
        url: urlForAjax,
        type: "POST",
        data: dataAjax,
        success : function(request){
           var jsonValid = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(
                   request.replace(/"(\\.|[^"\\])*"/g, ''))) &&
                   eval('(' + request + ')');
           if(jsonValid!==false){
               request = JSON.parse(request);
               if(imgid){
                   if( typeof request.result !== 'undefined' && request.edit ){
                     generateMSG('picture_success', request.result_msg);
                     return true;
                   }
               } else {
                   if( typeof request.result !== 'undefined' && request.result ){
                     generateMSG('picture_success', request.result_msg);
                     clearCanvas();
                     return true;
                   }
               }
           } else {
               generateMSG('picture_error', 'полученный JSON не валиден!');
           }
           generateMSG('picture_error', request.result_msg);
        }

     });
}
function generateMSG(action, msg){
    var typeAlert;
    action = action || 'picture_error';
    msg = msg || 'Сообщение не полученно';
    if(action=='picture_error'){
        typeAlert = 'danger';
    } else {
        typeAlert = 'success';
    }
    if($('#'+action).length){
        $('#'+action).show().find('.text_msg').text(msg);
    } else {
        $('#colors_canvas').before('\
            <div id="'+action+'" class="alert alert-'+typeAlert+' alert-dismissable myhide">\
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                <span class="text_msg">'+msg+'</span>\
            </div>'
        );
        $('#'+action).show();
    }
}
function removeImageCanvas(){
    
}