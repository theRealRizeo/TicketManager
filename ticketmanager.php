<?php
/*
Plugin Name: Ticket Manager
Description: Ticket manager is a plugin that allows you to sell all types of tickets ranging from different social events to bus tickets
Version: 1.0
Author: Rixeo
Author URI: http://thebunch.co.ke/
Plugin URI: http://thebunch.co.ke/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Ticket_Manager' ) ) :

  class Ticket_Manager{

    /**
    * Version
	  * @var string
	  */
	  public $version = '1.0';


    /**
	   * @var The single instance of the class
	   * @since 2.1
	   */
	  protected static $_instance = null;


    //Get instance
    public static function instance() {
      if ( is_null( self::$_instance ) ) {
    	 self::$_instance = new self();
      }
      return self::$_instance;
    }

    public function __construct() {

        $this->define_constants();
        $this->load_includes();
        $this->init_hooks();
    }

    private function define_constants(){
      $upload_dir = wp_upload_dir();
      $this->define( 'TCM_PLUGIN_FILE', __FILE__ );
			$this->define( 'TCM_PLUGIN_URL', plugin_dir_url( __FILE__ ) . 'ticketmanager/');
			$this->define( 'TCM_PLUGIN_RESOURCES_URL', TCM_PLUGIN_URL . 'resources/');
			$this->define( 'TCM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) . 'ticketmanager/');
      $this->define( 'TCM_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
      $this->define( 'TCM_VERSION', $this->version );
      $this->define( 'TCM_FILE_DIR', $upload_dir['basedir'] . '/ticketmanager/' );
    }


    /**
	   * Define constant if not already set
	  * @param  string $name
	  * @param  string|bool $value
	  */
  	private function define( $name, $value ) {
  		if ( ! defined( $name ) ) {
  			define( $name, $value );
  		}
  	}

    private function load_includes(){
      include_once( TCM_PLUGIN_DIR.'includes/tcm-core.php' );
    }

    private function init_hooks() {
      add_action( 'init', array( $this, 'init' ), 0 );
			TCM_Core::init();
    }

    /**
     * Load Localisation files.
     *
     * Locales are found in:
	   * 		- ticketmanager/languages/ticketmanager-LOCALE.mo (which if not found falls back to:)
	   * 		- WP_LANG_DIR/ticketmanager/ticketmanager-LOCALE.mo
     *
     */
    public function load_textdomain() {
      $locale = apply_filters( 'plugin_locale', get_locale(), 'ticketmanager' );
      load_textdomain( 'ticketmanager', WP_LANG_DIR . '/ticketmanager/ticketmanager-' . $locale . '.mo' );
      load_plugin_textdomain( 'ticketmanager', false, plugin_basename( dirname( __FILE__ ) ) . "/i18n/languages" );
    }

    public function init() {
      // Set up localisation
		  $this->load_textdomain();
    }

  }

  Ticket_Manager::instance();
else:
  function ticket_manager_error_notice() {
	    $message = __("Another plugin already using the class name Ticket_Manager exists. The Ticket Manager plugin will not work as expected");
      echo"<div class='error'> <p>$message</p></div>";
  }
  add_action( 'admin_notices', 'ticket_manager_error_notice' );
endif;
?>
