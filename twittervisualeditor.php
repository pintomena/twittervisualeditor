<?php
/*
Plugin Name: Twittervisualeditor
Version: 1.0
Description: Add button 'Share on Twitter' on Visual Editor
Author: Pinto
Author URI: http://bitado.com
Plugin URI: http://bitado.com
Text Domain: twittervisualeditor
Domain Path: /languages
*/

/*
 *  Shortcode share on Twitter. [sct_sharetwitter]
 *  Attributes:
 * 
 *  - text. Default is empty
 *  - size. Default is small. Other value is big
 *
 *  Example: [sct_sharetwitter text="Compartir en Twitter" size="big"]
 */
function twittervisualeditor_sharetwitter( $atts, $content = null ) {
    $atts_sharetwitter = shortcode_atts( array(
        'text' => 'Compartir en Twitter',
        'size' => 'small',
    ), $atts );

	$link_twitter = 'http://twitter.com/intent/tweet?url=' . urlencode( get_permalink() ) . '&amp;text=' . urlencode( get_the_title() );
	
	$bigclass = '';
	if ( $atts_sharetwitter['size'] == 'big' )
		$bigclass = 'sct-twitter-big';
	
	$content = '<a class="sct-twitter ' . $bigclass . '" target="_blank" href="' . $link_twitter . '">' . $atts_sharetwitter['text'] . '</a>';
	
	return $content;
}
add_shortcode( 'sct_sharetwitter', 'twittervisualeditor_sharetwitter' );


/*
 *  Enqueue css, javascript, and fonts files needed
 */
function twittervisualeditor_css() {

	wp_enqueue_style( 'shortcodetwitter-style', plugins_url( '/twittervisualeditor.css', __FILE__ ) );
    wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'twittervisualeditor_css' );


/*
 * Create a shortcode button for tinymce
 */
function twittervisualeditor_shortcode_button() {
	global $typenow;

	// check user permissions
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {

		// verify the post type
		if( in_array( $typenow, array( 'post', 'page' ) ) ) {

			// check if WYSIWYG is enabled
			if ( get_user_option( 'rich_editing' ) == 'true') {
				add_filter( 'mce_external_plugins', 'twittervisualeditor_add_tinymce_plugin' );
				add_filter( 'mce_buttons', 'twittervisualeditor_register_button' );
			}
		}
	}
}
add_action( 'admin_head', 'twittervisualeditor_shortcode_button' );


/*
 * Specify the path to the script with our plugin for TinyMCE
 */
function twittervisualeditor_add_tinymce_plugin($plugin_array) {
	
	$plugin_array['twittervisualeditor_button'] = plugins_url( '/twittervisualeditor-button.js', __FILE__ );
	return $plugin_array;
}


/*
 * Add button in TinyMCE
 */
function twittervisualeditor_register_button($buttons) {
   array_push( $buttons, 'twittervisualeditor_button');
   return $buttons;
}
