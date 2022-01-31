<?php
add_action('after_setup_theme', 'danetheme_setup');
function danetheme_setup()
{
	load_theme_textdomain('danetheme', get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('responsive-embeds');
	add_theme_support('automatic-feed-links');
	add_theme_support('custom-logo', array(
		'height' => 100,
		'width' => 100,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => array(
			'site-title',
			'site-description'
		) ,
	));

	global $content_width;
	if (!isset($content_width))
	{
		$content_width = 1920;
	}
	register_nav_menus(array(
		'main-menu' => esc_html__('Main Menu', 'danetheme')
	));
}

add_action('wp_enqueue_scripts', 'danetheme_enqueue');
function danetheme_enqueue()
{
	wp_enqueue_style('danetheme-style', get_stylesheet_uri());
	wp_enqueue_script('jquery');
}
add_action('wp_footer', 'danetheme_footer');
	function danetheme_footer()
{
?>

<?php
}
add_filter('document_title_separator', 'danetheme_document_title_separator');
function danetheme_document_title_separator($sep)
{
	$sep = '|';
	return $sep;
}
add_filter('the_title', 'danetheme_title');
function danetheme_title($title)
{
	if ($title == '')
	{
		return '...';
	}
	else
	{
		return $title;
	}
}
add_filter('nav_menu_link_attributes', 'danetheme_schema_url', 10);
function danetheme_schema_url($atts)
{
	$atts['itemprop'] = 'url';
	return $atts;
}
if (!function_exists('danetheme_wp_body_open'))
{
	function danetheme_wp_body_open()
	{
		do_action('wp_body_open');
	}
}
add_action('wp_body_open', 'danetheme_skip_link', 5);
function danetheme_skip_link()
{
	echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__('Skip to the content', 'danetheme') . '</a>';
}
add_filter('the_content_more_link', 'danetheme_read_more_link');
function danetheme_read_more_link()
{
	if (!is_admin())
	{
		return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'danetheme') , '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
	}
}
add_filter('excerpt_more', 'danetheme_excerpt_read_more_link');
function danetheme_excerpt_read_more_link($more)
{
	if (!is_admin())
	{
		global $post;
		return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'danetheme') , '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
	}
}
add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'danetheme_image_insert_override');
function danetheme_image_insert_override($sizes)
{
	unset($sizes['medium_large']);
	unset($sizes['1536x1536']);
	unset($sizes['2048x2048']);
	return $sizes;
}
add_action('widgets_init', 'danetheme_widgets_init');
function danetheme_widgets_init()
{
	register_sidebar(array(
		'name' => esc_html__('Sidebar Widget Area', 'danetheme') ,
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
add_action('wp_head', 'danetheme_pingback_header');
function danetheme_pingback_header()
{
	if (is_singular() && pings_open())
	{
		printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('comment_form_before', 'danetheme_enqueue_comment_reply_script');
function danetheme_enqueue_comment_reply_script()
{
	if (get_option('thread_comments'))
	{
		wp_enqueue_script('comment-reply');
	}
}
function danetheme_custom_pings($comment)
{
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url(comment_author_link()); ?></li>
<?php
}
add_filter('get_comments_number', 'danetheme_comment_count', 0);
function danetheme_comment_count($count)
{
	if (!is_admin())
	{
		global $id;
		$get_comments = get_comments('status=approve&post_id=' . $id);
		$comments_by_type = separate_comments($get_comments);
		return count($comments_by_type['comment']);
	}
	else
	{
		return $count;
	}
}

// Clean <head>
remove_action('wp_head', 'wp_generator');
function remove_dns_prefetch($hints, $relation_type)
{
	if ('dns-prefetch' === $relation_type)
	{
		return array_diff(wp_dependencies_unique_hosts() , $hints);
	}
	return $hints;
}
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

function remove_json_api()
{
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
	remove_action('rest_api_init', 'wp_oembed_register_route');
	add_filter('embed_oembed_discover', '__return_false');
	remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('after_setup_theme', 'remove_json_api');

function disable_json_api()
{
	add_filter('json_enabled', '__return_false');
	add_filter('json_jsonp_enabled', '__return_false');
	add_filter('rest_enabled', '__return_false');
	add_filter('rest_jsonp_enabled', '__return_false');
}
add_action('after_setup_theme', 'disable_json_api');

function my_remove_feeds()
{
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);
}
add_action('after_setup_theme', 'my_remove_feeds');
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function callback($buffer)
{
	$buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer);
	return $buffer;
}
function buffer_start()
{
	ob_start("callback");
}
function buffer_end()
{
	ob_end_flush();
}
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');

add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
	wp_deregister_style( 'contact-form-7' );
}

function remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) { 
				// Check whether the script has any dependencies
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
	}
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );

function scp_assets_dequeue() {
	wp_dequeue_style( 'custom-logo-css' ); // style id
} 
add_action( 'wp_enqueue_scripts', 'scp_assets_dequeue', 9999);

// Breadcrumbs
function get_breadcrumb() {
	echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
	if (is_category() || is_single()) {
		echo "  /  ";
		the_category(' &bull; ');
			if (is_single()) {
				echo "  /  ";
				the_title();
			}
	} elseif (is_tag() || is_single()) {
		echo "  /  ";
		single_tag_title();
			if (is_single()) {
				echo "  /  ";
				the_title();
			}
	} elseif (is_front_page()) {
		// nothing
	} elseif (is_page()) {
		echo "  /  ";
		echo the_title();
	} elseif (is_search()) {
		echo "  /  Search Results for... ";
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}

// Longer Excerpts
function theme_slug_excerpt_length($length)
{
	if (is_admin())
	{
		return $length;
	}
	return 400;
}
add_filter('excerpt_length', 'theme_slug_excerpt_length', 999);

define('UPDRAFTPLUS_ADMINBAR_DISABLE', true);

// Removed 'Protected: ' from protected pages/posts
add_filter( 'protected_title_format', 'remove_protected_text' );
	function remove_protected_text() {
	return __('%s');
} 