<?php get_header(); ?>
<main id="content">
	
	<?php 
		$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'category_name' => 'project'));
	?>
	<?php if ( $wpb_all_query->have_posts()) : ?>
	<h2>Projects</h2>
		<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<?php get_template_part( 'excerpt' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	
		<?php 
			$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'category_name' => 'writing'));
		?>
		<?php if ( $wpb_all_query->have_posts()) : ?>
		<h2 style="padding-top: 1em;">Writing</h2>
			<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
				<?php get_template_part( 'excerpt' ); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	
	<?php 
		$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1, 'category_name' => 'misc'));
	?>
	<?php if ( $wpb_all_query->have_posts()) : ?>
	<h2 style="padding-top: 2em;">Miscellaneous</h2>
		<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
			<?php get_template_part( 'excerpt' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { get_template_part( 'home-footer' ); } ?>
	
</main>
<?php get_footer(); ?>