<?php
class TCM_EventType{

  public $slug = "";

  public $name = "";

  public function __construct() {
    $this->init();

    add_action('add_meta_boxes_event', array(&$this, 'meta_boxes'));
    add_action('wp_insert_post', array(&$this, 'save_meta'), 10, 2);
  }

  /**
   * Custom functions go here and are called in the __construct() method
   *
   */
  public function init(){

  }

  function meta_boxes(){

  }

  function save_meta($post_id){

  }

}
?>
