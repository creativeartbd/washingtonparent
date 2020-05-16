<?php
/**
 * Declaring widgets
 *
 * @package everstrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'everstrap_widget_classes' );

if ( ! function_exists( 'everstrap_widget_classes' ) ) {
	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 *     @type array $args  {
	 *         An array of widget display arguments.
	 *
	 *         @type string $name          Name of the sidebar the widget is assigned to.
	 *         @type string $id            ID of the sidebar the widget is assigned to.
	 *         @type string $description   The sidebar description.
	 *         @type string $class         CSS class applied to the sidebar container.
	 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
	 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
	 *         @type string $after_title   HTML markup to append to the widget title when displayed.
	 *         @type string $widget_id     ID of the widget.
	 *         @type string $widget_name   Name of the widget.
	 *     }
	 *     @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 *         @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	function everstrap_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets ); //phpcs:ignore

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id   = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3';
			} elseif ( 6 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4';
			} elseif ( 2 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6';
			} elseif ( 1 === $widget_count ) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
}

add_action( 'widgets_init', 'everstrap_widgets_init' );

if ( ! function_exists( 'everstrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function everstrap_widgets_init() {

		// Right sidebar
		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'everstrap' ),
				'id'            => 'sidebar',
				'description'   => __( 'Sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);


		// Right bottom sidebar
		register_sidebar(
			array(
				'name'          => __( 'Sidebar right bottom', 'everstrap' ),
				'id'            => 'sidebar-right-bottom',
				'description'   => __( 'Sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// 970 X 90 ad
		register_sidebar(
			array(
				'name'          => __( '970 X 90 Advertisement', 'everstrap' ),
				'id'            => 'home-970-90-ad',
				'description'   => __( '970 X 90 advertisement here', 'everstrap' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);		

		// 970 X 90 ad
		register_sidebar(
			array(
				'name'          => __( '728 X 90 Advertisement', 'everstrap' ),
				'id'            => 'ad-728-90',
				'description'   => __( '728 X 90 advertisement here', 'everstrap' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);		

		// 320 X 50 ad
		register_sidebar(
			array(
				'name'          => __( '320 X 50 Advertisement', 'everstrap' ),
				'id'            => 'ad-320-50',
				'description'   => __( '320 X 50 advertisement here', 'everstrap' ),
				'before_widget' => '<div class="text-center mt-3 mb-5 hls-mobile-ad">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);		

		// Footer copyright
		register_sidebar(
			array(
				'name'          => __( 'Footer copyright section', 'everstrap' ),
				'id'            => 'footer-copyright',
				'description'   => __( 'Footer copyright widget area', 'everstrap' ),
				'before_widget' => '<div class="footer-copyright">',
				'after_widget'  => '</div>',
				'before_title'  => '<p>',
				'after_title'   => '</p>',
			)
		);

		// Single Directory
		register_sidebar(
			array(
				'name'          => __( 'Single Directory Sidebar', 'everstrap' ),
				'id'            => 'single-directory',
				'description'   => __( 'Single Directory Sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Sidebar Calendar
		register_sidebar(
			array(
				'name'          => __( 'Calendar Sidebar', 'everstrap' ),
				'id'            => 'sidebar-calendar',
				'description'   => __( 'Caldendar Sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Sidebar Calendar
		register_sidebar(
			array(
				'name'          => __( '404, Search & author page Sidebar', 'everstrap' ),
				'id'            => 'sidebar-404-search-author',
				'description'   => __( '404, search and author page Sidebar widget area', 'everstrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		

	}
}

if ( ! class_exists( 'Everstrap_ECP_Extended_Widget' ) ) {
	/**
	 *  Adds ECP_Extended_Widget widget.
	 */
	class Everstrap_ECP_Extended_Widget extends WP_Widget {
		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			add_action( 'widgets_init', array( $this, 'register_ecp_widget' ) );
			parent::__construct(
				'ecp_widget', // Base ID
				esc_html__( 'Event Calendar Pro', 'everstrap' ),
				array( 'description' => esc_html__( 'Show and Filters Events', 'everstrap' ) )
			);
		}

		/**
		 * Frontend display
		 *
		 * @param  array  $widget_args Argument
		 * @param  string $instance Instance
		 */
		public function widget( $widget_args, $instance ) {

			echo $widget_args['before_widget'];

			if ( ! empty( $instance['title'] ) ) {
				$widget_title = apply_filters( 'widget_title', $instance['title'] );
				echo '<div class="ecp-calendar-title">';
					echo '<h2>';
						_e( $widget_title, 'everstrap' );
					echo '</h2>';
				echo '</div>';
			}

			$events_page = ecp_get_settings( 'events_page', 'calendar', 'event_calendar_pro_page_settings' );

			$date = get_query_var( 'date' );
			if ( empty( $date ) ) {
				$date = date( 'Y-m-d', current_time( 'timestamp' ) );
			}

			$args = array(
				'order_by' 	=> 'start_date',
				'order'    	=> 'ASC',	
				'number' 	=> 3,		
			);

			if ( ! empty( $date ) ) {
				$args['start_date'] = $date;
			}

			$args = apply_filters( 'ecp_widget_events_query_args', $args );

			$events = ecp_get_event_list_extended( $args );			

			ob_start();
			ecp_get_template( 'widget/main.php', [
				'events'		=> $events,
				'events_page'	=> $events_page,
			]);

			$html = ob_get_clean();
			echo $html;
			echo $widget_args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @param array $instance Previously saved values from database.
		 *
		 * @see WP_Widget::form()
		 */
		public function form( $instance ) {
			$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Calendar', 'everstrap' );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_attr_e( 'Title Changes:', 'everstrap' ); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			</p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 * @see WP_Widget::update()
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                = array();
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			return $instance;
		}

		/**
		 * Register the wdiget
		 */
		public function register_ecp_widget() {
			register_widget( 'Everstrap_ECP_Extended_Widget' );
		}
	}

	$ecp_extended_widget = new Everstrap_ECP_Extended_Widget();
}