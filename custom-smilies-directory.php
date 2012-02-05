<?php
/*
Plugin Name: Custom Smilies Directory
Plugin URI: http://plugins.josepardilla.com/custom-smilies-directory/
Description: Light plugin that tells WordPress to load Smilies from your theme's directory. This allows you to use custom Smilies without loosing them when you update WordPress.
Version: 1.2
Author: Jos&eacute; Pardilla
Author URI: http://josepardilla.com/
*/


/**
 * Convert one smiley code to the icon graphic file equivalent.
 *
 * Looks up one smiley code in the $wpsmiliestrans global array and returns an
 * <img> string for that smiley.
 *
 * @global array $wpsmiliestrans
 * @since 1.0
 *
 * @param string $smiley Smiley code to convert to image.
 * @return string Image string for smiley.
 */
function jpm_translate_smiley($smiley) {
	global $wpsmiliestrans;

	if ( count($smiley) == 0 ) {
		return '';
	}

	$smiley = trim( reset($smiley) );
	$img = $wpsmiliestrans[$smiley];
	$smiley_masked = esc_attr( $smiley );

	$srcurl = apply_filters( 'smilies_src', get_stylesheet_directory_uri() . "/smilies/$img", $img, site_url() );

	return " <img src='$srcurl' alt='$smiley_masked' class='wp-smiley' /> ";
}


/**
 * Convert text equivalent of smilies to images.
 *
 * Will only convert smilies if the option 'use_smilies' is true and the global
 * used in the function isn't empty.
 *
 * @since 1.0
 * @uses $wp_smiliessearch
 *
 * @param string $text Content to convert smilies from text.
 * @return string Converted content with text smilies replaced with images.
 */
function jpm_convert_smilies($text) {
	global $wp_smiliessearch;
	$output = '';
	if ( get_option('use_smilies') && !empty($wp_smiliessearch) ) {
		// HTML loop taken from texturize function, could possible be consolidated
		$textarr = preg_split("/(<.*>)/U", $text, -1, PREG_SPLIT_DELIM_CAPTURE); // capture the tags as well as in between
		$stop = count($textarr);// loop stuff
		for ($i = 0; $i < $stop; $i++) {
			$content = $textarr[$i];
			if ((strlen($content) > 0) && ('<' != $content[0])) { // If it's not a tag
				$content = preg_replace_callback($wp_smiliessearch, 'jpm_translate_smiley', $content);
			}
			$output .= $content;
		}
	} else {
		// return default text.
		$output = $text;
	}
	return $output;
}


/**
 * Main Hook
 *
 * @since 1.0
 *
 */
function jpm_custom_smilies_init() {
	$smilies_path = STYLESHEETPATH . "/smilies/";
	if( file_exists($smilies_path) ) {
		remove_filter( 'the_content', 'convert_smilies' );
		remove_filter( 'the_excerpt', 'convert_smilies' );
		remove_filter( 'comment_text', 'convert_smilies' );
		add_filter( 'the_content', 'jpm_convert_smilies' );
		add_filter( 'the_excerpt', 'jpm_convert_smilies' );
		add_filter( 'comment_text', 'jpm_convert_smilies' );
	} else {
		add_action('admin_notices','jpm_convert_smilies_warning');
	}
}
add_action( 'init', 'jpm_custom_smilies_init' );


/**
 * Check for smilies directory in theme
 * 
 * Will check that the smilies directory exists in the theme, and if it doesn't
 * show an admin panel error to let the user know.
 *
 * @since 1.1
 *
 */
function jpm_convert_smilies_warning() {
	echo '<div id="jpm-convert-smilies-warning" class="error"><p><strong>';
	_e( 'Custom Smilies Directory needs your attenttion:', 'jpm_csd' );
	echo '</strong> ';
	_e( '<code>/smilies/</code> directory not found in the current theme. You have to upload your new smilies to your theme directory for them to work!', 'jpm_csd' );
	echo '</p></div>';
	
}


/**
 * Load textdomain
 *
 * @since 1.2
 *
 */
function jpm_custom_smilies_textdomain() {
	load_plugin_textdomain( 'jpm_csd', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action('init', 'jpm_custom_smilies_textdomain');


?>