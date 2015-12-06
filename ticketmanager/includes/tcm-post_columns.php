<?php

/**
 * Post Columns for our custom post types
 *
 */
class TCM_PostColumns{

  static function init(){

    //Columns for the Events. General columns
    add_filter('manage_event_posts_columns', array(__CLASS__, 'edit_event_columns'));
    add_action('manage_event_posts_custom_column', array(__CLASS__, 'edit_event_custom_columns'), 10, 2);

    //Columns for the tickets
    add_filter('manage_event_ticket_posts_columns', array(__CLASS__, 'edit_event_ticket_columns'));
    add_action('manage_event_ticket_posts_custom_column', array(__CLASS__, 'edit_event_ticket_custom_columns'), 10, 2);

    add_action('restrict_manage_posts', array(__CLASS__, 'edit_post_filter'));
  }

  static function edit_event_columns($old_columns){
    global $post_status;
    $columns['cb'] = '<input type="checkbox" />';
    $columns['thumbnail'] = __('Thumbnail', 'ticketmanager');
    $columns['title'] = __('Event Name', 'ticketmanager');
    $columns['type'] = __('Event Type', 'ticketmanager');
    $columns['status'] = __('Status', 'ticketmanager');
    $columns['sales'] = __('Sales', 'ticketmanager');
    $columns['location'] = __('Location', 'ticketmanager');
    return $columns;
  }

  static function edit_event_custom_columns($column, $id){
    global $post;

    $meta = get_post_custom();

    //unserialize
    foreach ($meta as $key => $val) {
        $meta[$key] = maybe_unserialize($val[0]);
    }

    switch ($column) {
      case "thumbnail":
          echo '<a href="' . get_edit_post_link() . '" title="' . __('Edit &raquo;') . '">';
          if (has_post_thumbnail()) {
              the_post_thumbnail(array(70, 70), array('title' => ''));
          }
          else {
              echo '<img width="70" height="70" src="holder.js/70x70>';
          }
          echo '</a>';
          break;
    }
  }

  static function edit_event_ticket_columns($old_columns){
    global $post_status;
    $columns['cb'] = '<input type="checkbox" />';
    $columns['title'] = __('Ticket ID', 'ticketmanager');
    $columns['event'] = __('Event', 'ticketmanager');
    $columns['cost'] = __('Cost', 'ticketmanager');
    $columns['status'] = __('Status', 'ticketmanager');
    $columns['payment_option'] = __('Payment Option', 'ticketmanager');
    $columns['purchase_date'] = __('Purchase Date', 'ticketmanager');
    return $columns;
  }

  static function edit_event_ticket_custom_columns($column, $id){

  }

  static function edit_post_filter() {
      global $current_screen;
      if ($current_screen->id == 'edit-event') {
          $selected_category = !empty($_GET['event_category']) ? $_GET['event_category'] : null;
          $selected_location = !empty($_GET['event_location']) ? $_GET['event_location'] : null;
          $dropdown_options = array('taxonomy' => 'event_category', 'show_option_all' => __('View all categories'), 'hide_empty' => 0, 'hierarchical' => 1, 'show_count' => 0, 'orderby' => 'name', 'name' => 'event_category', 'selected' => $selected_category);
          wp_dropdown_categories($dropdown_options);
          $dropdown_options = array('taxonomy' => 'event_location', 'show_option_all' => __('View all locations'), 'hide_empty' => 0, 'hierarchical' => 1, 'show_count' => 0, 'orderby' => 'name', 'name' => 'event_location', 'selected' => $selected_location);
          wp_dropdown_categories($dropdown_options);
      }
  }
}
?>
