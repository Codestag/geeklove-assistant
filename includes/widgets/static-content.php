<?php
/**
 * Display static content from an specific page.
 *
 * @package StagFramework
 * @subpackage GeekLove
 * @since GeekLove 2.0
 */
class Stag_Widget_Static_Content extends Stag_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'stag_widget_static_content';
		$this->widget_cssclass    = 'stag_widget_static_content';
		$this->widget_description = __( 'Displays content from a specific page.', 'geeklove-assistant' );
		$this->widget_name        = __( 'Section: Static Content', 'geeklove-assistant' );
		$this->settings           = array(
			'title'      => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'geeklove-assistant' ),
			),
			'page'       => array(
				'type'  => 'page',
				'std'   => '',
				'label' => __( 'Select Page:', 'geeklove-assistant' ),
			),
			'bg_color'   => array(
				'type'  => 'colorpicker',
				'std'   => geeklove_get_thememod_value( 'accent-color' ),
				'label' => __( 'Background Color:', 'geeklove-assistant' ),
			),
			'bg_opacity' => array(
				'type'  => 'number',
				'std'   => '20',
				'step'  => '5',
				'min'   => '0',
				'max'   => '100',
				'label' => __( 'Background Opacity:', 'geeklove-assistant' ),
			),
			'bg_image'   => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Background Image URL:', 'geeklove-assistant' ),
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#ffffff',
				'label' => __( 'Text Color:', 'geeklove-assistant' ),
			),
			'link_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#f8f8f8',
				'label' => __( 'Link Color:', 'geeklove-assistant' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		extract( $args );

		$title      = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$page       = $instance['page'];
		$bg_color   = $instance['bg_color'];
		$bg_opacity = $instance['bg_opacity'];
		$bg_image   = $instance['bg_image'];
		$text_color = $instance['text_color'];
		$link_color = $instance['link_color'];
		$post       = new WP_Query( array( 'page_id' => $page ) );

		echo $before_widget;

		// Allow site-wide customization of the 'Read more' link text
		$read_more = apply_filters( 'stag_read_more_text', __( 'Read more', 'geeklove-assistant' ) );
		?>
		<section class="inner-section">

			<?php if ( $post->have_posts() ) : ?>
				<?php
				while ( $post->have_posts() ) :
					$post->the_post();
?>
					<article id="post-<?php the_ID(); ?>"
														<?php
														post_class();
														stag_markup_helper( array( 'context' => 'entry' ) );
?>
 data-bg-color="<?php echo esc_attr( $bg_color ); ?>" data-bg-image="<?php echo esc_url( $bg_image ); ?>" data-bg-opacity="<?php echo esc_attr( $bg_opacity ); ?>" data-text-color="<?php echo esc_attr( $text_color ); ?>" data-link-color="<?php echo esc_attr( $link_color ); ?>">
						<?php
						if ( $title ) {
							echo $before_title . $title . $after_title;}
?>

						<div class="entry-content"<?php stag_markup_helper( array( 'context' => 'entry_content' ) ); ?>>
							<?php the_content( $read_more ); ?>
						</div>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>

		</section>

		<?php
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}

	/**
	 * Registers the widget with the WordPress Widget API.
	 *
	 * @return void.
	 */
	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Stag_Widget_Static_Content', 'register' ) );
