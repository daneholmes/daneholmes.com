<article>
	<div class="page-thumbnail-link">
		<a href="<?php the_permalink(); ?>">
			<div class="page-flex">
				<div class="page-thumbnail">
					<div class="scaled-container">
						<p class="title"><?php the_title(); ?></p>
						<div class="preview-content">
							<div class="paragraph">
								<p><?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="page-info">
					<h2 class="page-title"><?php the_title(); ?></h2>
					<time class="entry-date"><?php the_time( get_option( 'date_format' ) ); ?></time>
				</div>
			</div>
		</a>
	</div>
</article>