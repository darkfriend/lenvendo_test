<?

class view{
    #public $template_view;
    
    public function generate($content_view, $template_view = 'template_view.php', $data = null){
        include '/application/views/'.$template_view;
    }
}