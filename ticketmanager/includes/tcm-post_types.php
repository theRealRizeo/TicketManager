<?php
/**
 * Holds the post types
 *
 */
class TCM_PostTypes{

  static function init(){
    add_action('init', array(__CLASS__, 'register_post_types'), 0);
  }

  /**
   * Registr Post Types
   *
   */
  static function register_post_types(){

    // Register event categories
    register_taxonomy('event_category', 'event',
      apply_filters('ticketmanager_register_event_category',
          array(
            'hierarchical' => true,
            'label' => __('Event Categories', 'ticketmanager'),
            'singular_label' => __('Event Category', 'ticketmanager'),
            'rewrite' => array('with_front' => false)
            )
        )
    );

    // Register event tags
    register_taxonomy('event_tag', 'event',
      apply_filters('ticketmanager_register_event_tag',
        array(
          'hierarchical' => false,
          'label' => __('Event Tags', 'ticketmanager'),
          'singular_label' => __('Event Tag', 'ticketmanager'),
          'rewrite' => array('with_front' => false)
        )
      )
    );


    register_taxonomy('event_location', 'event',
      apply_filters('ticketmanager_register_event_location',
        array(
          'hierarchical' => false,
          'labels' => array(
            'name' => __( 'Locations', 'taxonomy general name' , 'ticketmanager'),
		  	  	'singular_name' => __( 'Location', 'taxonomy singular name' , 'ticketmanager'),
		  	  	'search_items' =>  __( 'Search Location', 'ticketmanager'),
		  	  	'all_items' => __( 'All Locations', 'ticketmanager' ),
		  	  	'parent_item' => __( 'Parent Location', 'ticketmanager' ),
		  	  	'parent_item_colon' => __( 'Parent Location', 'ticketmanager' ),
		  	  	'edit_item' => __( 'Edit Location', 'ticketmanager' ),
		  	  	'update_item' => __( 'Update Location', 'ticketmanager' ),
		  	  	'add_new_item' => __( 'Add New Location', 'ticketmanager' ),
		  	  	'new_item_name' => __( 'New Location Name', 'ticketmanager' ),
            'not_found' => __('No Locations Found', 'ticketmanager')
          ),
          'singular_label' => __('Event Location', 'ticketmanager'),
          'rewrite' => array('with_front' => false)
        )
      )
    );

    register_post_type('event',
      apply_filters('ticketmanager_register_event_type',
        array(
          'labels' =>
            array(
              'name' => __('Events', 'ticketmanager'),
              'singular_name' => __('Event', 'ticketmanager'),
              'menu_name' => __('Events', 'ticketmanager'),
              'all_items' => __('Events', 'ticketmanager'),
              'add_new' => __('New Event', 'ticketmanager'),
              'add_new_item' => __('Create New Event', 'ticketmanager'),
              'edit_item' => __('Edit Event', 'ticketmanager'),
              'edit' => __('Edit', 'ticketmanager'),
              'new_item' => __('New Event', 'ticketmanager'),
              'view_item' => __('View Event', 'ticketmanager'),
              'search_items' => __('Search Events', 'ticketmanager'),
              'not_found' => __('No Events Found', 'ticketmanager'),
              'not_found_in_trash' => __('No Events found in Trash', 'ticketmanager'),
              'view' => __('View Event', 'ticketmanager')
            ),
            'description' => __('Event Manager', 'ticketmanager'),
            'public' => true,
            'show_ui' => true,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-tickets-alt',
            'rewrite' => array('slug' => 'events','with_front' => false),
            'query_var' => true,
            'supports' => array('title', 'editor', 'author', 'excerpt', 'revisions', 'thumbnail'),
            'taxonomies' => array('event_category', 'event_tag',)
          )
        )
      );

      register_post_status('scheduled',
        array(
          'label' => __('Scheduled', 'ticketmanager'),
          'label_count' => _n_noop(__('Scheduled <span class="count">(%s)</span>', 'ticketmanager'), __('Scheduled <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event',
          'public' => false
        )
      );

      register_post_status('in_progress',
        array(
          'label' => __('In Progress', 'ticketmanager'),
          'label_count' => _n_noop(__('In Progress <span class="count">(%s)</span>', 'ticketmanager'), __('In Progress <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event',
          'public' => false
        )
      );

      register_post_status('complete',
        array(
          'label' => __('Complete', 'ticketmanager'),
          'label_count' => _n_noop(__('Complete <span class="count">(%s)</span>', 'ticketmanager'), __('Complete <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event',
          'public' => false
        )
      );


      register_post_type('event_ticket',
        apply_filters('ticketmanager_register_event_ticket_type',
          array(
            'labels' =>
              array(
                'name' => __('Ticket Sales', 'ticketmanager'),
                'singular_name' => __('Ticket Sale', 'ticketmanager'),
                'menu_name' => __('Ticket Sales', 'ticketmanager'),
                'all_items' => __('Ticket Sales', 'ticketmanager'),
                'edit_item' => __('Edit Ticket Sale', 'ticketmanager'),
                'edit' => __('Edit', 'ticketmanager'),
                'view_item' => __('View Ticket Sale', 'ticketmanager'),
                'search_items' => __('Search Ticket Sales', 'ticketmanager'),
                'not_found' => __('No Ticket Sales Found', 'ticketmanager'),
                'not_found_in_trash' => __('No Ticket Sales found in Trash', 'ticketmanager'),
                'view' => __('View Ticket Sale', 'ticketmanager')
              ),
              'description' => __('Event ticket sales', 'ticketmanager'),
              'public' => true,
              'show_ui' => true,
              'show_in_menu' => 'edit.php?post_type=event',
              'publicly_queryable' => true,
              'capability_type' => 'page',
              'hierarchical' => false,
              'rewrite' => array('slug' => 'tickets','with_front' => false),
              'query_var' => true,
              'supports' => array('title'),
              'capabilities' => array(
                'create_posts' => false, // Removes support for the "Add New" function ( use 'do_not_allow' instead of false for multisite set ups )
              ),
              'map_meta_cap' => true,
            )
          )
      );

      register_post_status('pending',
        array(
          'label' => __('Pending', 'ticketmanager'),
          'label_count' => _n_noop(__('Pending <span class="count">(%s)</span>', 'ticketmanager'), __('Pending <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event_ticket',
          'public' => false
        )
      );

      register_post_status('collected',
        array(
          'label' => __('Collected', 'ticketmanager'),
          'label_count' => _n_noop(__('Collected <span class="count">(%s)</span>', 'ticketmanager'), __('Collected <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event_ticket',
          'public' => false
        )
      );

      register_post_status('paid',
        array(
          'label' => __('Paid', 'ticketmanager'),
          'label_count' => _n_noop(__('Paid <span class="count">(%s)</span>', 'ticketmanager'), __('Paid <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event_ticket',
          'public' => false
        )
      );

      register_post_status('cancelled',
        array(
          'label' => __('Cancelled', 'ticketmanager'),
          'label_count' => _n_noop(__('Cancelled <span class="count">(%s)</span>', 'ticketmanager'), __('Cancelled <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event_ticket',
          'public' => false
        )
      );

      register_post_status('refunded',
        array(
          'label' => __('Refunded', 'ticketmanager'),
          'label_count' => _n_noop(__('Refunded <span class="count">(%s)</span>', 'ticketmanager'), __('Refunded <span class="count">(%s)</span>', 'ticketmanager')),
          'post_type' => 'event_ticket',
          'public' => false
        )
      );
  }
}
?>
