<?php
get_header();
?>
		<nav id="site-navigation" class="main-navigation">
			<h1><?php esc_html_e( 'Menu', 'susty' );?></h1>
			<div class="menu-items">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</div>
		</nav><!-- #site-navigation -->

<?php
get_footer();
