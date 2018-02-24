<?php

namespace BreatheCode\VCComposer\Component;

class VCRegexTester{
    
    const BASE_NAME = 'regextester';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   vc_map( array(
	      "name" => __( "Regex Tester", "regex-texter" ),
	      "base" => self::BASE_NAME,
	      "category" => __( "BreatheCode", "regex-texter"),
	      "params" => array(
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Box Height", "regex-texter" ),
		            "param_name" => "regexheight",
		            "value" => __( "200px", "regex-texter" ),
		            "description" => __( "The height of the test tool container.", "regex-texter" )
		        ),
		        array(
		            "type" => "textarea_raw_html",
		            "heading" => "Regular Expression",
		            "param_name" => "reg_expression",
		            "description" => __( "Type the regex to test", "regex-texter" )
		         ),
		        array(
		            "type" => "textarea",
		            "holder" => "div",
		            "heading" => __( "Content", "code-highliter" ),
		            "param_name" => "content",
		            "description" => __( "Type the content to test", "regex-highliter" )
		        )
	        )
	   ) );
    }
    
	function render( $atts , $content = null) 
	{
	    extract( shortcode_atts( array(
	      'reg_expression' => '',
	      'regexheight' => '200px'
	   ), $atts ) );

	   $reg_expression = rawurlencode($reg_expression);
	   $content = urlencode(base64_encode($content));
	   $srcURL = ASSETS_URL.'live-demos/js/regex-tester/?encoded=true&e='.$reg_expression.'&c='.$content;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$regexheight.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}
}