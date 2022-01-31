				</div>
			<footer id="footer">
				<div id="breadcrumbs">
					<?php get_breadcrumb() ?>
				</div>
				<div id="copyright">
					&copy; <?php echo esc_html( date_i18n( __( 'Y', 'blankslate' ) ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
				</div>
			</footer>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>