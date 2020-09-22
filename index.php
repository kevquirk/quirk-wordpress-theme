<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Susty
 */

get_header();
?>

	<div id="primary">
		<main id="main">

			<?php
				if ( is_front_page() && is_home() && ! get_query_var( 'menu' ) ) :
					?>
					<div id="home-about">
							<img class="header-logo" alt="Kev Quirk" style="padding-bottom:30px;" src="<?php echo esc_url( get_template_directory_uri() . '/images/kq-avatar.svg' ); ?>">
						  <p>Hi, I’m Kev Quirk. I’m a cyber security professional and privacy advocate from North West England. I use this blog to write about blogging, technology and web design.</p>
						  <ul class="social">
								<li>
						      <a title="Email" href="mailto:kev@craves.coffee"><i class="fa fa-envelope-open fa-2x" aria-hidden="true"></i></a>
						    </li>
						    <li>
						      <a title="Mastodon" href="https://fosstodon.org/@kev"><i class="fa fa-mastodon fa-2x" aria-hidden="true"></i></a>
						    </li>
						    <li>
						      <a title="Twitter" href="https://twitter.com/kevquirk"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
						    </li>
						    <li>
						      <a title="Keybase" href="https://keybase.io/kevq"><i class="fa fa-keybase fa-2x" aria-hidden="true"></i></a>
						    </li>
						  </ul>
					</div>
					<?php
				endif;
			?>

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

		else:

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main>
	</div>

	<!-- Pagination links -->
	<div class="pagination">
		<div class="nav-next alignleft"><?php next_posts_link( '<< Older posts' ); ?></div>
		<div class="nav-previous alignright"><?php previous_posts_link( 'Newer posts >>' ); ?></div>
	</div>

<?php

get_footer();
