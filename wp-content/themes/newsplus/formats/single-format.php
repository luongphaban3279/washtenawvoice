<?php
/**
 * Template part for single post image thumbnail
 *
 * @package NewsPlus
 * @since 3.4.2
 * @version 3.4.2
 */
if ( has_post_thumbnail() ) {
	$post_opts 			= get_post_meta( $posts[0]->ID, 'post_options', true );
	$hide_image 		= ( isset( $post_opts['hide_image'] ) ) ? $post_opts['hide_image'] : '';
	$show_image 		= ( isset( $post_opts['show_image'] ) ) ? $post_opts['show_image'] : '';
	$sng_width 			= get_option( 'sng_width' );
	$sng_height			= get_option( 'sng_height' );
	$sng_quality 		= get_option( 'sng_quality' );
	$sng_crop 			= get_option( 'sng_crop' );
	$schema 			= newsplus_schema( get_option( 'pls_schema' ), $sng_width, $sng_height );
	$thumb_id 			= get_post_thumbnail_id( get_the_ID() );

	if ( 'true' != get_option( 'pls_hide_feat_image' ) ) :
		if ( 'true' != $hide_image ) :
			$img_src = wp_get_attachment_image_src( $thumb_id, 'single_thumb' );
			$img = $img_src[0];
			$alt_text = basename( get_attached_file( $thumb_id ) );
			echo '<div' . $schema['img_cont'] . ' class="single-post-thumb">';
				if ( function_exists( 'newsplus_image_resize' ) ) {
					$crop = ! empty( $sng_crop ) ? true : false;
					$img = newsplus_image_resize( $img, $sng_width, $sng_height, $sng_crop, $sng_quality, '', '' );
				}
				echo '<img' . $schema['img'] . ' src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">';
				echo $schema['img_size'];
			echo '</div>';
			echo newsplus_post_thumbnail_caption();
		endif; // Hide image on individual post
	else :
		if ( 'true' == $show_image ) :
			$img_src = wp_get_attachment_image_src( $thumb_id, 'single_thumb' );
			$img = $img_src[0];
			$alt_text = basename( get_attached_file( $thumb_id ) );
			echo '<div' . $schema['img_cont'] . ' class="single-post-thumb">';
				if ( function_exists( 'newsplus_image_resize' ) ) {
					$crop = ! empty( $sng_crop ) ? true : false;
					$img = newsplus_image_resize( $img, $sng_width, $sng_height, $sng_crop, $sng_quality, '', '' );
				}
				echo '<img' . $schema['img'] . ' src="' . $img . '" class="attachment-post-thumbnail wp-post-image" alt="' . $alt_text . '">';
				echo $schema['img_size'];
			echo '</div>';
			echo newsplus_post_thumbnail_caption();
		endif; // Force featured image to show when globally hidden
	endif; // Hide image globally
}