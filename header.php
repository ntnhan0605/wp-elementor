<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
	<header id="header" class="header">
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-6">
						<div class="d-flex align-items-center justify-content-start">
							<a href="mailto:" class="email contact-info"><i class="mdi mdi-email"></i> <span>ntnhan0605@gmail.com</span></a>
							&nbsp;|&nbsp;
							<a href="tel:" class="phone contact-info"><i class="mdi mdi-phone-in-talk"></i> <span>0987 527 544</span></a>
						</div>
					</div>
					<div class="col-6">
						<div class="d-flex align-items-center justify-content-end">
							<a href="#fb" class="fb s-btn d-flex align-items-center justify-content-center btn-primary"><i class="mdi mdi-facebook"></i></a>
							<a href="#fb" class="tw s-btn d-flex align-items-center justify-content-center btn-info ml-2"><i class="mdi mdi-twitter"></i></a>
							<a href="#fb" class="yt s-btn d-flex align-items-center justify-content-center btn-danger ml-2"><i class="mdi mdi-youtube"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="header-background"></div>
			<div class="container">
				<div class="site-header">
					<div class="site-branding">
						<?php if (has_custom_logo()):
							ntn_the_custom_logo();
						else:
							if ( is_front_page() && is_home() ) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php else : ?>
								<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
							<?php endif;

							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo $description; ?></p>
							<?php endif; ?>
						<?php endif ?>
					</div>
					<div class="site-nav">
						<?php wp_nav_menu(array(
							'theme_location'  => 'main_menu',
							'menu'            => '',
							'container'       => 'ul',
							'menu_class'      => 'site-menu',
							'menu_id'         => 'site-menu',
							'echo'            => true,
							'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
						)); ?>
					</div>
					<div class="mobile-menu">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main id="main" class="main">