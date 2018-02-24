<?php

namespace BreatheCode\VCComposer\Component;

class VCCodeREPL{
    
    const BASE_NAME = 'coderepl';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   vc_map( array(
	      "name" => __( "Code REPL", "code-repl" ),
	      "base" => "coderepl",
	      "as_parent" => array('only' => 'codepreview,codehighliter'),
	      "js_view" => "VcColumnView",
	      "content_element" => true,
	      "category" => __( "BreatheCode", "breathecode"),
	      "show_settings_on_create" => true,
	      "is_containter" => true,
	      "params" => array(
	        array(
	            "type" => "dropdown",
	            "heading" => "Type",
	            "param_name" => "countainertype",
	            "value" => array('Tabs' => 'tabs',
	                            'Window' => 'window'),
	            "description" => __( "Select the language for codeview", "code-repl" )
	            )
	        ),
	    ));
    }
    
	function render( $atts , $content = null) {
	   extract( shortcode_atts( array(
	      'countainertype' => 'tabs'
	   ), $atts ) );
	   $content = wpb_js_remove_wpautop($content, true);
	   return '<div class="code-'.$countainertype.'">'.$content.'</div>';
	}
}