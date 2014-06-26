<?if(!defined("START") || START!==true)die();?>
<?
/**
 * Ядро въюшек.
 *
 * @author darkfriend
 */
class view{
    public function render($content_view, $template_view = EX_TEMPLATE, $data = null){
        //ob_start();
        include '/application/views/'.$template_view;
        //return ob_get_clean();
    }
}