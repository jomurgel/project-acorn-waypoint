<?php
/**
 * Custom Image endpoints.
 *
 * @package Acorn Theme
 * @source forked from https://github.com/BraadMartin/better-rest-api-featured-images
 * @since 1.0.0
 */

/**
 * Register featured images into api.
 *
 * @since  1.0.0
 */
function acorn_theme_get_all_images() {

	$post_types = get_post_types( array( 'public' => true ), 'objects' );

	foreach ( $post_types as $post_type ) {

		$post_type_name     = $post_type->name;
		$show_in_rest       = ( isset( $post_type->show_in_rest ) && $post_type->show_in_rest ) ? true : false;
		$supports_thumbnail = post_type_supports( $post_type_name, 'thumbnail' );

		// Make sure we can exit the REST API and we actually have a featured image.
		if ( $show_in_rest && $supports_thumbnail ) {

			// Compatibility with the REST API v2 beta 9+.
			if ( function_exists( 'register_rest_field' ) ) {

				register_rest_field( $post_type_name,
					'featured_image',
					array(
						'get_callback' => 'acorn_theme_get_all_image_fields',
						'schema'       => null,
					)
				);

			} elseif ( function_exists( 'register_api_field' ) ) {

				register_api_field( $post_type_name,
					'featured_image',
					array(
						'get_callback' => 'acorn_theme_get_all_image_fields',
						'schema'       => null,
					)
				);
			}
		}
	}
}
add_action( 'init', 'acorn_theme_get_all_images', 12 );

/**
 * Return the better_featured_image field.
 *
 * @since   1.0.0
 *
 * @param object $object      The response object.
 * @param string $field_name  The name of the field to add.
 * @param object $request     The WP_REST_Request object.
 *
 * @return  object|null
 */
function acorn_theme_get_all_image_fields( $object, $field_name, $request ) {

	// Only proceed if the post has a featured image.
	if ( ! empty( $object['featured_media'] ) ) {

		$image_id = (int) $object['featured_media'];

	} elseif ( ! empty( $object['featured_image'] ) ) {

		// This was added for backwards compatibility with < WP REST API v2 Beta 11.
		$image_id = (int) $object['featured_image'];

	} else {
		return null;
	}

	$image = get_post( $image_id );

	if ( ! $image ) {
		return null;
	}

	// This is taken from WP_REST_Attachments_Controller::prepare_item_for_response().
	$featured_image['id']            = $image_id;
	$featured_image['alt']           = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
	$featured_image['caption']       = $image->post_excerpt;
	$featured_image['description']   = $image->post_content;
	$featured_image['media_type']    = wp_attachment_is_image( $image_id ) ? 'image' : 'file';
	$featured_image['media_details'] = wp_get_attachment_metadata( $image_id );
	$featured_image['post']          = ! empty( $image->post_parent ) ? (int) $image->post_parent : null;
	$featured_image['source_url']    = wp_get_attachment_url( $image_id );

	if ( empty( $featured_image['media_details'] ) ) {

		$featured_image['media_details'] = new stdClass;

	} elseif ( ! empty( $featured_image['media_details']['sizes'] ) ) {

		$img_url_basename = wp_basename( $featured_image['source_url'] );

		foreach ( $featured_image['media_details']['sizes'] as $size => &$size_data ) {

			$image_src = wp_get_attachment_image_src( $image_id, $size );

			if ( ! $image_src ) {
				continue;
			}

			$size_data['source_url'] = $image_src[0];
		}

	} elseif ( is_string( $featured_image['media_details'] ) ) {

		// This was added to work around conflicts with plugins that cause
		// wp_get_attachment_metadata() to return a string.
		$featured_image['media_details'] = new stdClass();
		$featured_image['media_details']->sizes = new stdClass();

	} else {

		$featured_image['media_details']['sizes'] = new stdClass;

	}

	return apply_filters( 'better_rest_api_featured_image', $featured_image, $image_id );
}
