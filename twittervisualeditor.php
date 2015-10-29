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



