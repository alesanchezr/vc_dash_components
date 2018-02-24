<?php

if(!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/');

require ABSPATH . 'vendor/autoload.php';



if(class_exists('WPAS\Messaging\WPASAdminNotifier')) WPASAdminNotifier::loadTransientMessages();