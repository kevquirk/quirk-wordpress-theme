<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Susty
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<div class="post-title">
		<?php
		if ( is_singular() ) :
			the_title( '<h1>', '</h1>' );
		else :
			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
		</div>
			<div class="entry-meta">
				<i class="las la-calendar"></i>
				<?php
				susty_wp_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header>

	<?php susty_wp_post_thumbnail(); ?>

	<div>
		<?php
		if ( is_home() && is_front_page() or is_category() ) :
			get_the_title();
		else:
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'susty' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
			get_the_title()
			) );
		endif;
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'susty' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer>
		<?php susty_wp_entry_footer(); ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
