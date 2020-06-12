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
						  <p>Hi, I’m Kev Quirk. I’m a cyber security professional and privacy advocate from North West England. My interest include drawing, fishkeeping, motorbikes & open source software.</p>
						  <ul class="social">
								<li>
						      <a title="Email" href="mailto:email@me.kevq.uk"><i class="las la-envelope-open-text la-2x"></i></a>
						    </li>
						    <li>
						      <a title="Mastodon" href="https://fosstodon.org/@kev"><i class="lab la-mastodon la-2x"></i></a>
						    </li>
						    <li>
						      <a title="Twitter" href="https://twitter.com/kevquirk"><i class="lab la-twitter la-2x"></i></a>
						    </li>
						    <li>
						      <a title="Keybase" href="https://keybase.io/kevq"><i class="lab la-keybase la-2x"></i></a>
						    </li>
						  </ul>
					</div>

					<!-- INDIEWEB H-CARD use this link to verify it's ok - https://indiewebify.me/validate-h-card/ -->
					<section style="display: none;" class="h-card">
						<!-- About me -->
								<span class="p-name">Kev Quirk</span>
								<span class="p-note">I'm a cyber security professional and privacy advocate from North West England. My interest include drawing, fishkeeping, motorbikes & open source software.</span>

						<!-- My Indieweb profile pic -->
								<img class="u-photo" src="https://kevq.b-cdn.net/wp-content/uploads/2019/11/400px-round-grey-glasses.png"/>

						<!-- My location -->
								<span class="p-locality">North West England</span>

						<!-- Links -->
								<a class="u-url u-uid" href="https://kevq.uk"></a>
								<a class="u-email" rel="me" href="mailto:email@me.kevq.uk"></a>
								<a class="u-url" rel="me" href="https://fosstodon.org/kev"></a>
								<a class="u-url" rel="me" href="https://twitter.com/kevquirk"></a>
								<a class="u-url" rel="me" href="https://keybase.io/kevq"></a>

						<!-- Categories -->
								<span class="p-category">Drawing</span>
								<span class="p-category">Fishkeeping</span>
								<span class="p-category">Motorbikes</span>
								<span class="p-category">Open Source Software</span>
								<span class="p-category">Privacy</span>
					</section>
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

	<div style="text-align:center;" class="pagination">
		<?php posts_nav_link( '  ', 'Newer Posts', 'Older Posts' ); ?>
	</div>

<?php

get_footer();
