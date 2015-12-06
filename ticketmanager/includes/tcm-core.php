<?php
/**
 * Core Class for Ticket Manager
 *
 */
class TCM_Core{

  /**
   * Initialise the plugin.
   * Loads all other necesarry files and sets up plugin
   */
  static function init(){
    self::load_includes();
    TCM_PostTypes::init();
    TCM_PostColumns::init();
  }

  static function load_includes(){
    include_once( TCM_PLUGIN_DIR.'includes/tcm-post_types.php' );
    include_once( TCM_PLUGIN_DIR.'includes/tcm-post_columns.php' );
    include_once( TCM_PLUGIN_DIR.'includes/tcm-event_type.php' );
  }

  static function admin_css(){

  }

  static function admin_scripts(){
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-accordion');
    wp_enqueue_script('tcm-holder', TCM_PLUGIN_RESOURCES_URL . 'js/holder.js', array('jquery'), TCM_VERSION);
  }
}
?>
