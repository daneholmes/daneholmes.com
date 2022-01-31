<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<?php wp_head(); ?>
	<script data-host="https://microanalytics.io" data-dnt="false" src="https://microanalytics.io/js/script.js" id="ZwSg9rf6GA" async defer></script>
</head>
<body>
	<div id="wrapper">
		<header id="header">
			<div id="branding">
				<div id="site-title">
					<?php
					if ( is_front_page() || is_home() || is_front_page() && is_home() ) { 
						get_template_part( 'header-home' );
					} else {
						get_template_part( 'header-entry' );
					}
					?>
				</div>
			</div>
		</header>
		<div id="container">