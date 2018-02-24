<?php

namespace BreatheCode\VCComposer\Component;

class VCReplitClassRoom{
    
    const BASE_NAME = 'replitclass';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   vc_map( array(
	      "name" => __( "Replit Classroom", "replit-class" ),
	      "base" => self::BASE_NAME,
	      "category" => __( "BreatheCode", "breathecode"),
	      "params" => array(
	        array(
	            "type" => "textfield",
	            "holder" => "div",
	            "heading" => __( "URL", "replit-class" ),
	            "param_name" => "classurl",
	            "value" => __( "Write the URL here", "replit-class" ),
	            "description" => __( "Replit URL to embed the class", "replit-class" )
	            )
	        )
	   ) );
    }
    
	function render( $atts , $content = null) 
	{
	   extract( shortcode_atts( array(
	      'classurl' => ''
	   ), $atts ) );

	   return '<iframe frameborder="0" width="100%" height="600px" src="'.$classurl.'"></iframe>';
	}
}