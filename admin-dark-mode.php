<?php

/**
 * Plugin Name: Admin Dark Mode
 * Description: Make WordPress admin dashboard darker just in one click.
 * Author: jTigerson j.tigerson@gmail.com
 * Text Domain: adm-drk
 * Version: 0.1
 */

// No thank you
if ( ! defined( 'ABSPATH' ) ) die();

//require_once 'class-admin-dark-mode.php';
//$admin_dark_mode_obj = new Admin_Dark_Mode;

class Admin_Dark_Mode {

    public function __construct(){
        
        add_action( 'plugins_loaded', array( __CLASS__, 'load_text_domain' ), 10, 0 ); 

        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_js' ), 99, 0 );

        add_action( 'admin_head', array( __CLASS__, 'drk_mod_css' ) );

        add_action( 'admin_notices', array( __CLASS__, 'on_of_btn' ) );
    }

    public static function load_js(){

        if( is_admin() ){

            $js_url  = plugins_url( 'js/admin-dark-mode.js' , __FILE__ );
            $css_url = plugins_url( 'css/darkmode.css' , __FILE__ );

            wp_register_script( 'admin-dark-mode.js', $js_url, array('jquery'), '1.0', false );
            wp_enqueue_script( 'admin-dark-mode.js' );

            wp_localize_script('admin-dark-mode.js', 'ADMIN_DARK_MOD', array(
                'css_url' => $css_url,
            ) );

        }
        
    }

    public static function on_of_btn(){

        echo '<div id="drk-on-off-btn"> <button> Dark Mode </button> </div>';

    }


    // We need some CSS to position the paragraph
    public static function drk_mod_css() {
        // This makes sure that the positioning is also good for right-to-left languages
        $x = is_rtl() ? 'left' : 'right';

        echo "
        <style type='text/css'>
        #drk-on-off-btn {
            float: $x;
            padding-$x: 15px;
            padding-top: 5px;       
            margin: 0;
            font-size: 11px;
        }
        </style>
        ";
    }

    

    public static function load_text_domain() {

		load_plugin_textdomain( 'adm-drk', false, untrailingslashit( dirname( __FILE__ ) ) . '/languages' );

	}

    
}

new Admin_Dark_Mode();


