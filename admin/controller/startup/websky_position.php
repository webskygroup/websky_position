<?php
namespace Opencart\Admin\Controller\Extension\webskyPosition\Startup;
/**
 * Class webskyPosition
 *
 * @package Opencart\Admin\Controller\Extension\webskyPosition\Module
 */
class webskyPosition extends \Opencart\System\Engine\Controller {
	public function index(): void
    {
    
        if ($this->config->get('module_websky_position_status')) {

        $this->event->register('view/design/layout_form/after', new \Opencart\System\Engine\Action('extension/websky_position/startup/websky_position.view_design_layout'));
		}
    }

   
    public function view_design_layout(string &$route, array &$args,mixed &$output): void 
    {

    
	$find= 	'<footer id="footer">';

                    $replace="<script src='https://code.jquery.com/ui/1.13.2/jquery-ui.js'></script>
  <script>
  $( function() {
    $( '#sortable,#sortable1,#sortable2,#sortable3,#sortable4,#sortable5' ).sortable({
       stop: function(event, ui) {
       var element_id = ui.item.attr('id');
        var order_component = $(this).sortable('toArray');
       console.log(order_component);
      
        var i, n;
        for (i = 0, n = order_component.length; i < n; i++) {
           var index = order_component[i].substring(11);
           var sorto='\'layout_module['+index+'][sort_order]\'';
           $('input[name='+sorto+']').val(i);   
         }
            
    }
    });
  } );
  </script>
   <link rel='stylesheet' href='//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css'>
     <style>
     td {
  cursor: move;
}
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  </style>
<footer id='footer'>";
                     
                   	$output=str_replace($find,$replace,$output);


                    
	$find= 	'<div class="input-group input-group-sm">';

    $replace='<div class="input-group input-group-sm"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>';
     
       $output=str_replace($find,$replace,$output);


       $find= 	'<tbody>';
       $replace='<tbody id="sortable1">';
       $output=$this->str_replace_nth($find, $replace, $output, 1);
        
       $find= 	'<tbody>';
       $replace='<tbody id="sortable2">';
       $output=$this->str_replace_nth($find, $replace, $output, 1);

       $find= 	'<tbody>';
       $replace='<tbody id="sortable3">';
       $output=$this->str_replace_nth($find, $replace, $output, 1);

       $find= 	'<tbody>';
       $replace='<tbody id="sortable4">';
       $output=$this->str_replace_nth($find, $replace, $output, 1);

    }

    public function str_replace_nth($search, $replace, $subject, $nth)
{
    $found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
    if (false !== $found && $found > $nth) {
        return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
    }
    return $subject;
}
}
