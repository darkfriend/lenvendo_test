<?

class view{
    #public $template_view;
    
    public function render($content_view, $template_view = EX_TEMPLATE, $data = null){
        //ob_start();
        //echo $content_view;
        include '/application/views/'.$template_view;
        //return ob_get_clean();
    }
}