<?php
add_action( 'rest_api_init', 'register_post_fields' );

// Register post fields.
function register_post_fields() {
    register_rest_field( 'post', 'post_views', array(
        'get_callback'    => array( $this, 'get_post_views' ),
        'update_callback' => array( $this, 'update_post_views' ),
        'schema' => array(
            'description' => __( 'Post views.' ),
            'type'        => 'integer'
        ),
    ));
}

// Get post views.
function get_post_views( $post_obj ) {
    $post_id = $post_obj['id'];
    return get_post_meta($post_id, 'post_views', true);
}

// Update post views.
function update_post_views( $value, $post, $key ) {

    $post_id = update_post_meta( $post->ID, $key, $value );

    if ( false === $post_id ) {
        return new WP_Error(
        'rest_post_views_failed',
        __( 'Failed to update post views.' ),
        array( 'status' => 500 )
        );
    }

    return true;
}