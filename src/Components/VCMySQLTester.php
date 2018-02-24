<?php

namespace WPAS\VCDash\Components;

class MySQLTester extends BaseComponent{
    
    const BASE_NAME = 'mysqltester';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register(){
    	
	   vc_map( array(
	      "name" => __( "MySQL Tester", "mysql-texter" ),
	      "base" => self::BASE_NAME,
	      "category" => __( "BreatheCode", "mysql-texter"),
	      "params" => array(
	      		array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Box Height", "mysql-texter" ),
		            "param_name" => "mysqlheight",
		            "value" => __( "200px", "mysql-texter" ),
		            "description" => __( "The height of the test tool container.", "mysql-texter" )
		        ),
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Database sample", "mysql-texter" ),
		            "param_name" => "databasename",
		            "value" => __( "chat", "mysql-texter" ),
		            "description" => __( "Name of the database (used on the .sql and .png files)", "mysql-texter" )
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => "Table Styles",
		            "param_name" => "tablestyles",
		            "value" => array('hor-minimalist-a' => 'hor-minimalist-a',
		                            'hor-minimalist-b' => 'hor-minimalist-b',
		                            'ver-minimalist' => 'ver-minimalist',
		                            'box-table-a' => 'box-table-a',
		                            'box-table-b' => 'box-table-b',
		                            'hor-zebra' => 'hor-zebra',
		                            'ver-zebra' => 'ver-zebra',
		                            'newspaper-a' => 'newspaper-a',
		                            'newspaper-b' => 'newspaper-b'),
		            "description" => __( "Select the style of the tables", "mysql-highliter" )
		         )
	        )
	   ) );
    }
    
	function render( $atts , $content = null){
		
	    extract( shortcode_atts( array(
	      'databasename' => '',
	      'mysqlheight' => '200px',
	      'tablestyles' => ''
	   ), $atts ) );

	   $srcURL = ASSETS_URL.'live-demos/sql/mysql-tester/?db='.$databasename.'&tablestyle='.$tablestyles;
	   $htmlcontent = '<iframe style="border:0; overflow:hidden;" frameborder="0" width="100%" height="'.$mysqlheight.'" src="'.$srcURL.'"></iframe>';
	   return $htmlcontent;
	}
}