<?php get_header(); ?>
<main id="content">
	<h2>Writing</h2>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php get_template_part( 'excerpt' ); ?>
		<?php comments_template(); ?>
	<?php endwhile; endif; ?>
	<?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { get_template_part( 'home-footer' ); } ?>
</main>
<?php get_footer(); ?>