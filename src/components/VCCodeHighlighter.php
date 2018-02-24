<?php
namespace BreatheCode\VCComposer\Component;

class VCCodeHighlighter{
    
    const BASE_NAME = 'codehighliter';
    
    function __construct(){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( self::BASE_NAME, array($this,'render'));
    }
    
    function register()
    {
	   vc_map( array(
	      "name" => __( "Code Highliter", "code-highliter" ),
	      "base" => self::BASE_NAME,
	      "category" => __( "BreatheCode", "code-highliter"),
	      "params" => array(
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Show line numbers", "code-highliter" ),
	            "param_name" => "linenumbers",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "Line numbers on the left of the container.", "code-highliter" )
	         ),
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Is this new code example?", "code-highliter" ),
	            "param_name" => "newcodeexample",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "True if you added the code before the base64 encodeing update.", "code-highliter" )
	         ),
	        array(
	            "type" => "dropdown",
	            "heading" => "Language",
	            "param_name" => "codelanguage",
	            "value" => array('html' => 'markup',
	                            'JS' => 'javascript',
	                            'JSON' => 'json',
	                            'CSS' => 'css',
	                            'SQL' => 'sql',
	                            'PHP' => 'php',
	                            'GIT' => 'git',
	                            'Bash' => 'bash',
	                            'Python' => 'python',
	                            'C#' => 'csharp',
	                            'HTTP' => 'http',
	                            'Sass' => 'scss',
	                            'Nginx' => 'nginx',
	                            'YAML' => 'yaml'),
	            "description" => __( "Select the language for codeview", "code-highliter" )
	         ),
	        array(
	            "type" => "textarea_raw_html",
	            "holder" => "div",
	            "weight" => 20,
	            "heading" => __( "Content", "code-highliter" ),
	            "param_name" => "content",
	            "value" => __( "Write the code here", "code-highliter" ),
	            "description" => __( "Write you code lines.", "code-highliter" )
	        ),
	         array(
	            "type" => "checkbox",
	            "heading" => __( "Is it active on the REPL?", "code-highliter" ),
	            "param_name" => "active",
	            "value" => array('on'   => 'true' ),
	            "description" => __( "If it's inside a Code REPL and you want it shown by default", "code-highliter" )
	         )
	      )
	   ) );
    }
    
	function render( $atts , $content = null) {
	   extract( shortcode_atts( array(
	      'linenumbers' => 'false',
	      'newcodeexample' => 'false',
	      'active' => '',
	      'codelanguage' => 'markup'
	   ), $atts ) );

	   if(!$newcodeexample or $newcodeexample=='false') {
	   	$content = wpb_js_remove_wpautop($content, true);
	   }
	   else {
	    $content = urldecode(base64_decode($content));
	   	if($codelanguage=='html' || $codelanguage=='markup') $content = htmlentities($content);
	   }

	   if(!$linenumbers or $linenumbers!='true') $numerstring = '';
	   else $numerstring = 'line-numbers';
	  
	   return '<pre class="'.$numerstring.' '.($active ? 'active':'').'"><code class="language-'.$codelanguage.'">'.$content.'</code></pre>';
	}
}