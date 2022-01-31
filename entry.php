<article>
	<header>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h1>
		<?php edit_post_link(); ?>
		<?php if ( !is_search() ) { get_template_part( 'entry', 'meta' ); } ?>
	</header>
	
	<?php get_template_part( 'entry', ( is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
	<?php if ( is_singular() ) { get_template_part( 'entry-footer' ); } ?>
</article>