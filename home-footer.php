<footer class="entry-footer">	
	<?php 
		$user_info = get_userdata(1);
		$user_email = $user_info->user_email;
	?>
	<nav id="menu">
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
	</nav>
</footer>