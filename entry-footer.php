<footer class="entry-footer">
	<div class="tag-links"><?php the_tags(); ?></div>
	<div class="return-home"><a href="<?php echo home_url(); ?>">Home</a></div>
	<nav id="menu">
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
	</nav>
</footer>