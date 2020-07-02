<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Susty
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/png" href="<?php echo esc_url( get_template_directory_uri() . '/images/favicon.png' ); ?>"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel='stylesheet'  href="<?php echo esc_url( get_template_directory_uri() . '/fonts/merriweather/merriweather.css' ); ?>" type='text/css' media='all' />
	<link rel='stylesheet'  href="<?php echo esc_url( get_template_directory_uri() . '/fonts/fira/fira.css' ); ?>" type='text/css' media='all' />
	<link rel='stylesheet'  href="<?php echo esc_url( get_template_directory_uri() . '/fonts/lineawesome/css/line-awesome.min.css' ); ?>" type='text/css' media='all' />

<!-- START PLAUSIBLE ANALYTICS -->
	<script async defer data-domain="kevq.uk" src="https://stats.kevq.uk/js/index.js"></script>
<!-- END PLAUSIBLE ANALYTICS -->

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a class="to-top" name="top"></a>

<div id="page">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'susty' ); ?></a>

	<header id="masthead">
		<?php
		if ( is_front_page() && is_home() && ! get_query_var( 'menu' ) ) :
			?>
			<h1><a class="header-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Kev Quirk</a><span class="logo_dot"></span></h1>
			<?php
		else :
			?>
			<h1><a class="header-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Kev Quirk</a><span class="logo_dot"></span></h1>
			<?php
		endif;
		if ( has_nav_menu( 'menu-1' ) ) :
			if ( get_query_var( 'menu' ) ) :
				?>
				<a class="menu" id="susty-back-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Close<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'susty' ); ?></span></a>
				<script>
					var susty_home_url = '<?php echo esc_url( home_url( '/' ) ); ?>';
					if ( 0 === document.referrer.indexOf( susty_home_url ) ) {
						document.getElementById( 'susty-back-link' ).href = document.referrer;
					}
				</script>
				<?php
			else :
				?>
				<a class="head-search" href="/search"><i class="la la-search la-lg"></i></a>
				<a class="menu" href="<?php echo esc_url( ( get_option( 'permalink_structure' ) ? home_url( '/menu/' ) : home_url( '/?menu' ) ) ); ?>"><?php esc_html_e( 'Menu', 'susty' ); ?></a>
				<?php
			endif;
		endif;
		?>

	</header>

	<div id="content">
