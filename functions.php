<?php
/**
 * Plugin Name: WPAS VC Dash Components
 * Plugin URI: https://github.com/alesanchezr/vc_dash_components
 * Description: Extending Visual Composer with components meant for building an elarning
 * Author: Alejandro Sanchez
 * Author URI: http://alesanchezr.com
 * Version: 0.1.0
 */

if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');

require ABSPATH . 'vendor/autoload.php';

/**
 * Everything related to the visual composer settings and components.
 * */
$codePreview = new \VCDash\Components\CodePreview();

if(class_exists('WPAS\Messaging\WPASAdminNotifier')) WPASAdminNotifier::loadTransientMessages();