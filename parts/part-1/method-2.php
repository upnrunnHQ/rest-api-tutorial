<?php
$args = array(
    'type'     	   => 'string',
    'description'  => 'A meta key associated with post views.',
    'single'   	   => true,
    'show_in_rest' => true,
);

register_meta( 'post', 'post_views', $args );