var __slice = Array.prototype.slice;
(function($) {
  var Sketch;
  $.fn.sketch = function() {
    var args, key, sketch;
    key = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
    if (this.length > 1) {
      $.error('Sketch.js can only be called on one element at a time.');
    }
    sketch = this.data('sketch');
    console.log('start');
    
    //var srcBackground = $('canvas').data('img');
    //if(srcBackground.length>0){
        //this.context.globalCompositeOperation = 'lighten';
        //$oldContext = this.context;
        //console.log($oldContext);
        //var canvCont = document.getElementById('colors_sketch').getContext('2d');
        //var newBackground = new Image();
        //newBackground.src = srcBackground;
        //newBackground.setAttribute('crossorigin','annonymous');
        //console.log(this.context);
        //var canvCont = this.context;
        /*newBackground.onload = function(){
            canvCont.drawImage(newBackground, 0, 0, $('#colors_sketch').width(), $('#colors_sketch').height());
            canvCont.globalCompositeOperation = 'source-over';
            //canvCont.clearRect(0, 0, $('canvas').width(), $('canvas').height());
            //canvCont.drawImage(canvCont, 0, 0, $('canvas').width(), $('canvas').height());
            //this.redraw();
        };*/
        //this.redraw();
        //this.context.drawImage(newBackground, 0, 0, $('canvas').width(), $('canvas').height());
        //this.context.globalAlha = 0.5;

        //this.context = this.canvas.setContext($oldContext);
    //}
    
    if (typeof key === 'string' && sketch) {
      if (sketch[key]) {
        if (typeof sketch[key] === 'function') {
          return sketch[key].apply(sketch, args);
        } else if (args.length === 0) {
          return sketch[key];
        } else if (args.length === 1) {
          return sketch[key] = args[0];
        }
      } else {
        return $.error('Sketch.js did not recognize the given command.');
      }
    } else if (sketch) {
      return sketch;
    } else {
      this.data('sketch', new Sketch(this.get(0), key));
      return this;
    }
  };
  Sketch = (function() {
    function Sketch(el, opts) {
      this.el = el;
      this.canvas = $(el);
      this.context = el.getContext('2d');
      this.options = $.extend({
        toolLinks: true,
        defaultTool: 'marker',
        defaultColor: '#000000',
        defaultSize: 5
      }, opts);
      this.painting = false;
      this.color = this.options.defaultColor;
      this.size = this.options.defaultSize;
      this.tool = this.options.defaultTool;
      this.actions = [];
      this.action = [];
      this.canvas.bind('click mousedown mouseup mousemove mouseleave mouseout touchstart touchmove touchend touchcancel', this.onEvent);
      
      if (this.options.toolLinks) {
        $('body').delegate("a[href=\"#" + (this.canvas.attr('id')) + "\"]", 'click', function(e) {
          var $canvas, $this, key, sketch, _i, _len, _ref;
          $this = $(this);
          $canvas = $($this.attr('href'));
          sketch = $canvas.data('sketch');
          _ref = ['color', 'size', 'tool'];
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            key = _ref[_i];
            if ($this.attr("data-" + key)) {
              sketch.set(key, $(this).attr("data-" + key));
            }
          }
          if ($(this).attr('data-download')) {
            sketch.download($(this).attr('data-download'));
          }
          return false;
        });
      }
    }
    Sketch.prototype.download = function(format) {
      var mime, urlForAjax, dataAjax;
      format || (format = "png");
      if (format === "jpg") {
        format = "jpeg";
      }
      mime = "image/" + format;
//      if(this.bgImage){
//          var picture = new Image();
//          picture.src = this.bgImage;
//          var canvCont = this.context;
//          var camvas = this.canvas;
//          picture.onload = function(){
//              canvCont.drawImage(picture, 0, 0, $('canvas').width(), $('canvas').height());
//              
//          };
//      }
       //console.log(this.context.save());
          //console.log(this.context.canvas());
        
      /*var srcBackground = $('canvas').data('img');
      if(srcBackground.length>0){
          //this.context.globalCompositeOperation = 'lighten';
          $oldContext = this.context;
          //console.log($oldContext);
          var newBackground = new Image();
          newBackground.src = srcBackground;
          //newBackground.setAttribute('crossorigin','annonymous');
          console.log(this.context);
          this.context.drawImage(newBackground, 0, 0, $('canvas').width(), $('canvas').height());
          this.context.globalAlha = 0.5;
          this.redraw();
          //this.context = this.canvas.setContext($oldContext);
      }*/
      //console.log(this.el.toDataURL(mime));
      //var datds = this.el.toDataURL(mime);
      //console.log(format);
        //console.log(this.canvas.getContext('2d'));
        var imgid = parseInt($('#colors_sketch').data('imgid'));
        //console.log('imgid='+imgid);
        //console.log('toDataURL='+this.el.toDataURL(mime));
        if(imgid){
            urlForAjax = '/ajax/picture_edit/';
            dataAjax = 'data='+this.el.toDataURL(mime)+'&imgid='+parseInt(imgid)+'&format='+format;
        } else {
            urlForAjax = '/ajax/picture_add/';
            dataAjax = 'data='+this.el.toDataURL(mime)+'&format='+format;
        }
        initAjax(urlForAjax,dataAjax,imgid);
        /*var generateMSG = function(action, msg){
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
      
        $.ajax({
           url: urlForAjax,
           type: "POST",
           //data: 'data='+this.el.toDataURL(mime)+'&imgid='+parseInt($('#colors_sketch').data('imgid')),
           data: dataAjax,
           success : function(request){
              //console.log(request);
              var jsonValid = !(/[^,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]/.test(
                      request.replace(/"(\\.|[^"\\])*"/g, ''))) &&
                      eval('(' + request + ')');
              console.log('user='+jsonValid);
              if(jsonValid!==false){
                  request = JSON.parse(request);
                  console.log(request);
                  if(imgid){
                      if( typeof request.result !== 'undefined' && request.edit ){
                        generateMSG('picture_success', request.result_msg);
                        console.log(request);
                        return true;
                      }
                  } else {
                      if( typeof request.result !== 'undefined' && request.result ){
                        generateMSG('picture_success', request.result_msg);
                        console.log(request);
                        return true;
                      }
                  }
                  
                  //console.log(request);
              } else {
                  generateMSG('picture_error', 'полученный JSON не валиден!');
                  //$('#picture_error').show().find('.text_msg').text('полученный JSON не валиден!');
              }
              generateMSG('picture_error', request.result_msg);
           }

        });*/
      //return window.open(this.el.toDataURL(mime));
    };
    Sketch.prototype.set = function(key, value) {
      this[key] = value;
      return this.canvas.trigger("sketch.change" + key, value);
    };
    Sketch.prototype.startPainting = function() {
      this.painting = true;
      //console.log('Sketch.prototype.startPainting');
      return this.action = {
        tool: this.tool,
        color: this.color,
        size: parseFloat(this.size),
        events: []
      };
    };
    Sketch.prototype.stopPainting = function() {
      if (this.action) {
        this.actions.push(this.action);
      }
      this.painting = false;
      this.action = null;
      return this.redraw();
    };
    Sketch.prototype.onEvent = function(e) {
      if (e.originalEvent && e.originalEvent.targetTouches) {
        e.pageX = e.originalEvent.targetTouches[0].pageX;
        e.pageY = e.originalEvent.targetTouches[0].pageY;
      }
      $.sketch.tools[$(this).data('sketch').tool].onEvent.call($(this).data('sketch'), e);
      e.preventDefault();
      return false;
    };
    Sketch.prototype.redraw = function() {
      var sketch;
      this.el.width = this.canvas.width();
      this.context = this.el.getContext('2d');
      sketch = this;
      $.each(this.actions, function() {
        if (this.tool) {
          return $.sketch.tools[this.tool].draw.call(sketch, this);
        }
      });
      if (this.painting && this.action) {
        return $.sketch.tools[this.action.tool].draw.call(sketch, this.action);
      }
    };
    return Sketch;
  })();
  $.sketch = {
    tools: {}
  };
  $.sketch.tools.marker = {
    onEvent: function(e) {
      switch (e.type) {
        case 'mousedown':
        case 'touchstart':
          //console.log('event startPainting');
          this.startPainting();
          break;
        case 'mouseup':
        case 'mouseout':
        case 'mouseleave':
        case 'touchend':
        case 'touchcancel':
          //console.log('event stopPainting');
          this.stopPainting();
          //this.initPicture();
      }
      if (this.painting) {
        this.action.events.push({
          x: e.pageX - this.canvas.offset().left,
          y: e.pageY - this.canvas.offset().top,
          event: e.type
        });
        return this.redraw();
      }
    },
    draw: function(action) {
      var event, previous, _i, _len, _ref;
      this.context.lineJoin = "round";
      this.context.lineCap = "round";
      this.context.beginPath();
      this.context.moveTo(action.events[0].x, action.events[0].y);
      _ref = action.events;
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        event = _ref[_i];
        this.context.lineTo(event.x, event.y);
        previous = event;
      }
      this.context.strokeStyle = action.color;
      this.context.lineWidth = action.size;
      return this.context.stroke();
    }
  };
  return $.sketch.tools.eraser = {
    onEvent: function(e) {
      return $.sketch.tools.marker.onEvent.call(this, e);
    },
    draw: function(action) {
      var oldcomposite;
      oldcomposite = this.context.globalCompositeOperation;
      this.context.globalCompositeOperation = "copy";
      action.color = "rgba(0,0,0,0)";
      $.sketch.tools.marker.draw.call(this, action);
      return this.context.globalCompositeOperation = oldcomposite;
    }
  };
})(jQuery);