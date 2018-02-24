<?php

namespace BreatheCode\VCComposer\Component;

class VCReplitExercise{
    
    const BASE_NAME = 'replitexercise';
    private $classes;
    
    function __construct($classes){
        $this->classes = $classes;
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   array_unshift($this->classes,array("#"=>'Select an exercise topic'));
	   vc_map( array(
	      "name" => __( "Replit Exercise", "breathecode" ),
	      "base" => "replitexercise",
	      "category" => __( "BreatheCode", "breathecode"),
	      "params" => array(
		        array(
		            "type" => "textfield",
		            "holder" => "div",
		            "heading" => __( "Exercise Box Title", "breathecode" ),
		            "param_name" => "exercisetitle",
		            "description" => __( "What is going to appear on the exercise box", "breathecode" )
		        ),
		        array(
		            "type" => "dropdown",
		            "heading" => "Exercise Class Key",
		            "param_name" => "exercisestringkey",
		            "value" => $this->classes,
		            "description" => __( "You have to pick one from the cohort exercises list", "breathecode" )
		         ),
	      		array(
		            "type" => "textarea_html",
		            "holder" => "div",
		            "heading" => __( "Description", "breathecode" ),
		            "param_name" => "content",
		            "description" => __( "Description for the objective of the exercises.", "breathecode" )
		        )
	        )
	   ) );
    }
    
	function render( $atts , $content = null) 
	{
	    extract( shortcode_atts( array(
	      'exercisestringkey' => '',
	      'exercisetitle' => ''
	   ), $atts ) );
	    $terms = wp_get_object_terms(get_current_user_id(),'user_cohort',array('orderby'=>'term_order'));
	    $term_id = 0;
	    $htmlcontent = '';
	    $linkURL = '';
	    if(count($terms)>0) 
	    {
	    	$term_id = $terms[0]->term_id;
	    	$term_name = $terms[0]->name;
	    	$term_meta = get_option( "taxonomy_".$term_id );
	    	if(isset($term_meta['replit_'.$exercisestringkey])) $linkURL = $term_meta['replit_'.$exercisestringkey];
		   $formatedContent = wpb_js_remove_wpautop($content, true);
		   $htmlcontent = '
				<section class="vc_cta3-container">
				<div class="vc_general vc_cta3 vc_cta3-style-classic vc_cta3-shape-rounded vc_cta3-align-center vc_cta3-color-pink vc_cta3-icons-on-border vc_cta3-icon-size-xl vc_cta3-icons-left vc_cta3-actions-bottom  wpb_animate_when_almost_visible wpb_appear wpb_start_animation">
					<div class="vc_cta3-icons">
						<div class="vc_icon_element vc_icon_element-outer vc_icon_element-align-left">
							<div class="vc_icon_element-inner vc_icon_element-color-mulled_wine vc_icon_element-size-xl vc_icon_element-style- vc_icon_element-background-color-grey"><span class="vc_icon_element-icon fa fa-flask"></span>
							</div>
						</div>
					</div>
					<div class="vc_cta3_content-container">
						<div class="vc_cta3-content">
							<header class="vc_cta3-content-header">
								<h2>'.$exercisetitle.'</h2>									
							</header>
							<p style="text-align: center;">'.$formatedContent.'</p>
						</div>
						<div class="vc_cta3-actions">
							<div class="vc_btn3-container vc_btn3-center">';
			if($linkURL!='') $htmlcontent .= '<a class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-block vc_btn3-color-warning" href="'.$linkURL.'#term='.$term_name.'" title="" target="_blank" rel="nofollow">'.pll__('View more').'</a>';
			else $htmlcontent .= '<a class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-block vc_btn3-color-default" href="#term='.$term_name.'" title="" rel="nofollow">'.pll__( 'Your teacher has not uploaded this exercises in the platform yet' ).'.</a>';
			$htmlcontent .=	'</div>
						</div>
					</div>
				</div>
				</section>';

	    }
	   return $htmlcontent;
	}
}