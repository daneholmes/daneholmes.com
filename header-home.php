<div class="profile-header">
	<div class="profile-photo-wrap">
		<div class="profile-photo">
			<?php
			  $imageobject = get_field('profile_picture');
			  if( !empty($imageobject) ):
				echo '<img alt="' . $imageobject['alt'] . '" class="profile-imgage" src="' . $imageobject['sizes']['medium'] . '" srcset="' . $imageobject['sizes']['medium_large'] .' '. $imageobject['sizes']['medium_large-width'] .'w, '. $imageobject['sizes']['medium'] .' '.  $imageobject['sizes']['medium-width'] .'w, '. $imageobject['sizes']['thumbnail'] .' '.  $imageobject['sizes']['thumbnail-width'] .'w">';
			  endif; ?>
		</div>
	</div>

	<div class="profile-info">
		<h1><?php echo get_bloginfo( 'name' ); ?></h1>
		<p><?php the_field('position'); ?> at <?php the_field('location'); ?></p>
		<a href="<?php echo home_url(); ?>" class="link">daneholmes.com</a>
	</div>
</div>


<div class="status-bubble">
	<div class="snippet">
		<div class="status">
			<p><?php the_field('blurb'); ?></p>
		</div>
		<time class="entry-date"><?php the_field('update_date'); ?></time>
	</div>
</div>

<h2>About</h2>
<p style="padding-bottom: 2em;"><?php the_field('about'); ?></p>
