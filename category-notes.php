<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Susty
 */

get_header();
?>

	<div id="primary">
		<main id="main">

			<header>
				<?php
				echo( '<h1 class="notes-title"><i class="las la-edit la-lg"></i>My Notes</h1>' );
				echo( '<p>I use this page to share my opinions, thoughts and posts on more generalist topics, as well as my other interests.</p><br>');
				?>
			</header>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			?>
			<div class="post-title">
	 			<?php
	 			if ( is_singular() ) :
	 				the_title( '<h1>', '</h1>' );
	 			else :
	 				the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	 			endif;
	 			?>
	 		</div>
			<div class="entry-meta">
				<?php susty_wp_posted_on(); susty_wp_entry_footer(); ?>
			</div><!-- .entry-meta -->
			<br>
		<?php

			endwhile;

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<!-- Pagination links -->
	<div class="pagination">
		<div class="nav-next alignleft"><?php next_posts_link( '<< Older posts' ); ?></div>
		<div class="nav-previous alignright"><?php previous_posts_link( 'Newer posts >>' ); ?></div>
	</div>

<?php
get_footer();
