<?

class view{
    #public $template_view;
    
    public function render($content_view, $template_view = DEFAULT_TEMPLATE, $data = null){
        //ob_start();
        include '/application/views/'.$template_view;
        //return ob_get_clean();
    }
}