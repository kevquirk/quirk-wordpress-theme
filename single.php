<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Susty
 */

get_header();
?>

	<div id="primary">
		<main id="main">

		<?php
			$old_post = 60*60*24*365; // A Year
			if((date('U')-get_the_time('U')) > $old_post) {
	  	echo '<div class="old-notice">This post was last updated over a year ago, therefore the contents of this post may be out of date. Please see my <a href="/disclaimer">disclaimer</a> for more information.</div>';
			}
		?>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
		?>

		<!-- Add newsletter to the bottom of all posts. -->
		<div class="post-newsletter">
			<h2>Subscribe for more!</h2>
			<p>You will receive monthly emails with updates and previews of upcoming posts. To find out more, <a href="/newsletter">click here</a>.</p>
			<?php echo do_shortcode( '[swp-forms id=2222]' ); ?>
		</div>

		<hr>
		<!-- Adds previous & next post links -->
		<div id="post-links">
			<p class="alignleft">
				<?php previous_post_link('&laquo; %link'); ?>
			</p>
			<p class="alignright">
					<?php next_post_link('%link &raquo;'); ?>
			</p>
		</div>
		<div style="clear: both;"></div>
		<hr>

		<h2><i class="fa fa-comments"></i> Comments</h2>
		<p class="comment-guidelines">Please read my <a target="blank" href="/commenting-guidelines">commenting guidelines</a> before posting a comment.</p>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
?>
