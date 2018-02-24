<?php

namespace WPAS\VCDash\Components;

class BaseComponent{
    
    protected $baseName = null;
    
    function __construct($baseName){
        add_action( 'vc_before_init', array($this,'register'));
        add_shortcode( $baseName, array($this,'render'));
    }
    
    function register(){
        throw new WPASException('The component '.$baseName.' needs a register function');
    }
    function render(){
        throw new WPASException('The component '.$baseName.' needs a render function');
    }
}